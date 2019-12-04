<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-white p-2" style="box-shadow: 0px 0px 3px black;">
                <div id="receiptContainer">
                    <div class="header text-center font-weight-bold pb-2" style="border-bottom: 2px dotted black; letter-spacing: 1px;">
                        <p class="h3 "><img src="/image/bullesyeLogo.png" alt="Logo" class="brand-image" style="margin-right:-20px;height: 40px; width: 40px;">&nbsp;&nbsp; <span class="text-danger p-0" style="text-decoration: underline; font-size:20px;">BULLSEYE</span></p>
                        <span style="font-size: 12px;">Receipt #: {{ receiptDetails.transaction_number }}</span><br>
                        <span style="font-size: 12px;"> <i class="fas fa-user"></i> {{ name  }}</span> <br>  
                        <span style="font-size: 12px;">278 Ermin Garcia Ave, Quezon City, 1102 Metro Manila</span>
                    </div>   
                    <div class="body" >
                        <table class="table table-responsive" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Unit/Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody style="border-bottom: 2px solid black;">
                                <tr v-for="item in receiptDetails.transaction_details[0].transaction_items" :key="item.id">
                                    <td style="word-wrap: break;">{{ item.item }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.price }}</td>
                                </tr>
                            </tbody>
                            <tfoot class="font-weight-bold">
                                <tr>
                                    <td colspan="2">Total:</td>
                                    <td>₱{{ total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <h6 class="text-center bg-dark p-1 text-uppercase">Terms and Conditions</h6>
                        
                        <ol style="font-size: 9px;" class="pl-3 ">
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima veniam earum dicta quo unde aliquam.</li>
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima veniam earum dicta quo unde aliquam.</li>
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima veniam earum dicta quo unde aliquam.</li>
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima veniam earum dicta quo unde aliquam.</li>
                        </ol>
                        <h6 class="text-center">Thank you!!!</h6>
                    </div>
                </div>
                <button class="btn btn-danger btn-block" @click="printReceipt"> <i class="fa fa-print" aria-hidden="true"></i> Print</button>
            </div>
            <div class="col-10 p-1" style="box-shadow: 0px 0px 3px gray;" id="receiptContainer">
                <h1 class="text-center bg-dark p-2 font-weight-bold">Transaction List</h1>
                <div class="jumbotron text-center" v-show="loadingPage">
                    <h1><i>Loading...</i></h1>
                </div>
                <div class="row p-3 justify-content-center" v-show="!loadingPage">
                    <div class="col-4" v-for="transaction in transactions" :key="transaction.id" >
                        <div class="card text-dark" style="border: 2px dotted #D0211C;">
                            <div class="card-body p-3">
                                <h3 class="bg-primary p-2 font-weight-bold text-center text-uppercase">Receipt #: {{ transaction.transaction_number }}</h3>
                                <h5 class="card-title font-weight-bold">{{ transaction.customers.name }}</h5>
                                <p class="card-text">
                                   <span class="font-weight-bold">Transaction Date:</span><span class="text-muted"> {{ transaction.created_at | moment("dddd, MMMM Do, YYYY") }}</span> <br>
                                </p>
                                <!-- <span>Printed: <span class="badge badge-secondary p-2">3 times</span> </span> -->
                                <a :href="'/receipt/'+transaction.id" class="btn btn-danger float-right w-50"> GO <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="row p-3">
                    <div class="col-5">
                        <button class="btn btn-primary" @click="transactionList('prev')"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev</button>
                    </div>
                    <div class="col-2">
                        <span class="font-weight-bold">page {{ this.page }} / {{ this.pageCount }}</span>
                    </div>
                    <div class="col-5">
                        <button class="btn btn-primary float-right" @click="transactionList('next')">Next <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            receiptDetails : {},
            total: 0,
            transactions: {},
            name:'',
            page: 2,
            pageCount: 0,
            loadingPage: true
        }
    },
    methods: {
        printReceipt(){
            this.$htmlToPaper('receiptContainer', () => {
                console.log("success");
            });
        },
        transactionList(action){
            this.loadingPage = true;
            if(action == 'next'){
                if(this.page == this.pageCount){
                    this.page = this.pageCount;
                    this.$toastr.w(`You're on the last page.`)
                    this.loadingPage = false;
                }else{
                    this.page = this.page + 1;
                    this.loadTransaction();
                }
            }else if(action == 'prev'){
                if(this.page == 1){
                    this.page = 1;
                    this.$toastr.w(`You're on the first page.`);
                    this.loadingPage = false;
                }else{
                    this.page = this.page - 1;
                    this.loadTransaction();
                }
            }else{
                this.page = 1;
                this.loadTransaction();
            }

            
        },
        loadTransaction(){
            axios.get('/api/alltransaction/'+this.$route.params.id+'?page='+this.page).then(({data}) => {
                this.transactions = data.transactions.data
                this.pageCount = Math.ceil( data.transactions.total / data.transactions.per_page );
                this.loadingPage = false;
            });
        },
        switchReceipt(id){
            this.$router.push({path: '/receipt/'+id});
        },
        
        receipt(){
            let total = [];
            axios.get('/api/fetchtransaction/receipt/'+this.$route.params.id).then(({data}) => {
                this.receiptDetails = data
               this.name = data.customers.name;
                data.transaction_details[0].transaction_items.forEach(element => {
                    total.push(element.price);
                });

                this.total =  total.reduce(function(total, num){ 
                    return total + num 
                }, 0);
                  
            });
        },
    },
    created(){
        this.transactionList();
        
        this.receipt();
        

        
    }
}
</script>
<style scoped>
    @import url('https://fonts.googleapis.com/css?family=BioRhyme|Roboto&display=swap');
    #receiptContainer{
        font-family: 'BioRhyme', serif;
    }
    .table {
    border-bottom:0px !important;
    }
    .table th, .table td {
        border: 1px !important;
    }
    .fixed-table-container {
        border:0px !important;
    }
</style>