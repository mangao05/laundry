<template>
<div class="container border border-secondary p-3 mb-3" id="receiptContainer">

    <div class="row">
        <div class="col-lg-4 " style="border-right: 1px solid black; ">
                <vue-simple-suggest
                    v-model="selected"
                    :list="customers"
                    :styles="autoCompleteStyle"
                    :destyled=true
                    :filter-by-query="true"
                    display-attribute="title"
                    value-attribute="id"
                    placeholder="Customer">
                </vue-simple-suggest>

            <div id="PrintTransaction">
                <div class="text-center">
                      <p class="text-center"><img src="/image/bullesyeLogo.png" alt="Logo" width="30" style="margin-left:50px;"><span class="text-danger" style="text-decoration: underline;margin-right:75px;"> BULLSEYE</span></p>
                    <h4>Receipt #: {{ transaction_number }}</h4>
                    <h4> <i class="fas fa-user"></i> {{ customer }}</h4>
                     <h6>278 Ermin Garcia Ave, Quezon City, 1102 Metro Manila</h6>
                     
                </div>
            <div style="height: 30vh; border-bottom: 1px solid black; overflow-y: auto;" class="mb-2">
                <table class="table table-light table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Unit/Qty</th>
                            <th>Price</th>
                            <td class="text-danger"> <i class="fa fa-times" aria-hidden="true"></i> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="postServices.length == 0">
                            <td colspan="4" class="text-center"> <i> No Data</i>  </td>
                        </tr>
                        <tr v-else v-for="(service, index) in postServices" :key="service.id">
                            <td>{{ service.service }}</td>
                            <td>{{ service.quantity }}</td>
                            <td>{{ service.price }}</td>
                            <td>
                                <a href="" class="btn btn-danger btn-sm" @click.prevent="removeItem(index)">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table ">
                <tbody>
                    <tr>
                        <td colspan="3">
                            <span class="h2" style="font-size: 15px;">Total:</span>
                        </td>
                        <td class="text-right">
                            <span class="h2" style="font-size: 15px;">₱{{ subtotal | number('0,0') }}</span>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="3">
                            <span class="h2" style="font-size: 12px;">Cash Tendered:</span>
                        </td>
                        <td class="text-right">
                            <span class="h2" style="font-size: 12px;">{{ amountRendered | currency }}</span>
                        </td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <span class="h2" style="font-size: 12px;">Change</span>
                        </td>
                        <td class="text-right">
                            <span class="h2" style="font-size: 12px;">{{ change | currency }}</span>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
            </div>
            <div>
                <button class="btn btn-info btn-block" @click="PrintTransaction" >
                    Pay Now
                </button>
                <button id="payBtn" class="btn btn-success btn-block" @click="saveTransaction()" :disabled="isDisabled" ><i class="fas fa-save  nav-icon  "></i>
                    Save Transaction
                </button>
            </div>
            <!-- End COlumn -->
        </div>
        <div class="col-lg-8">
            <h1 class="text-uppercase text-danger font-weight-bold text-center" style="text-decoration: underline; font-stretch:expanded; font-family: 'Oswald', sans-serif;" ><i>Product List</i></h1>
            <hr style="border: 2px solid black;">
            <div class="row">
                <div class="col-6 text-right">
                    <nav class="nav nav-pills nav-justified ">
                        <a class="nav-item nav-link p-3 font-weight-bold text-danger border border-success" :class="(dryActive) ? 'active' : ''" href="" @click.prevent="service('item')">Dry Clean</a>
                    </nav>
                </div>
                <div class="col-6">
                     <nav class="nav nav-pills nav-justified ">
                        <a class="nav-item nav-link border border-success p-3 font-weight-bold text-danger" :class="(!dryActive) ? 'active' : ''" href="" @click.prevent="service('kilo')">Assorted Clothes</a>
                    </nav>
                </div>
            </div>
            <hr style="border: 2px solid black;">
            
            <div class="row justify-content-center m-3 p-2">
                <div v-for="service in services.data" :key="service.id"  class="col-lg-4 mb-2">
                        <div class="p-1">
                            <div class="row rounded border border-info" @click="openQuantityModal(service.id, service.service, service.price)" style="box-shadow: 0px 0px 3px gray; cursor:pointer;">
                                <div class="col-md-4 p-2" >
                                    <img :src="'/serviceIcon/'+service.icon" class="img-fluid">
                                </div>
                                 <div class="col-md-8 p-1 bg-info text-center">
                                    <span class="text-uppercase">{{ service.service }}</span> <br>
                                        
                                     <span class="text-dark">
                                         {{ service.price }} {{ (service.type == 'kilo') ? ' / kg' : ' / pc' }}
                                     </span>
                                </div>
                            </div>
                        </div>     
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <button class="btn btn-primary" @click="service(serviceType, 'prev')"><i class="fa fa-arrow-left" aria-hidden="true" ></i> Prev</button>
                </div>
                <div class="col-2">
                     <span class="font-weight-bold">page {{ this.page }} / {{ this.pageCount }}</span>
                </div>
                <div class="col-5">
                   
                    <button class="btn btn-primary float-right" @click="service(serviceType, 'next')">Next <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                </div>
            </div>
        </div>          
    </div>
 
    <div class="modal fade " id="enterQuantity" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark p-4 ">
                <div class="modal-body">
                   <num-key @closeModal="closeModal()"  :options="numberOptions"></num-key>
                </div>
            </div>
        </div>
    </div>
    <payment-modal :subtotal="subtotal"></payment-modal>
</div>

</template>
<script>
import VueSimpleSuggest from 'vue-simple-suggest'
import 'vue-simple-suggest/dist/styles.css' // Using a css-loader
import PaymentModal from './modal/PaymentModal.vue';
import NumKeyComponent from './keyboard/NumberKeysComponent.vue';
export default {
    data(){
        return {
            autoCompleteStyle : {
                vueSimpleSuggest: "position-relative mb-3",
                inputWrapper: "",
                defaultInput : "form-control text-center font-weight-bold text-uppercase border border-info",
                suggestions: "position-absolute list-group z-1000 w-100 text-center",
                suggestItem: "list-group-item"
            },
            numberOptions: {
                number_only : true,
                label : 'Enter Qty/Kg'
            },
            services : {},
            service_name: 'Service',
            service_id: 0,
            service_price: 0,
            quantity: '',
            postServices: [],
            dryActive: true,
            customers: [],
            customer: 'POS Customer',
            selected : '',
            subtotal: '0.00',
            amountRendered:0,
            CashReceived:'0',
            change:'0',
            transaction_number: '0000',
            page: 2,
            serviceType : 'item',
            pageCount: 0,
            error:false,
            isDisabled: true

        }
    },
    components: {
      VueSimpleSuggest,
      'payment-modal' : PaymentModal,
      'num-key' : NumKeyComponent
    },
    methods: {
        closeModal(){
            this.isDisabled = true;
            $('#enterQuantity').modal('hide');    
        },
        returnAmount(value){
            $("#enterQuantity").modal('hide');
            this.quantity = value;
            this.storeService();
        },
        service(type = 'item', page){
            if(type == 'item'){
                this.dryActive = true;
            }else{
                this.dryActive = false;
            }

            if(page == 'next'){
                if(this.page == this.pageCount){
                    this.page = this.pageCount;
                }else{
                    this.page = this.page + 1;
                }
            }else if(page == 'prev'){
                if(this.page == 1){
                    this.page = 1;
                }else{
                     this.page = this.page - 1;
                }
            }else{
                 this.page = 1;
            }

            this.serviceType = type;
            
            axios.get('/api/services?page='+this.page+'&filter='+this.serviceType).then(({data}) => {
                this.services = data.service;
                this.pageCount = Math.ceil(data.service.total / data.service.per_page);
                this.transaction_number = data.transaction_number;
            })
            
        },
        openQuantityModal(id, service, price){
            this.service_name = service;
            this.service_id = id;
            this.service_price = price;
            $("#enterQuantity").modal({
                backdrop: 'static',
                keyboard: false
            });
            
            this.amountRendered = 0;
            this.change = 0;
        },
        storeService(){     
           if(this.quantity <= 0){
              this.error = true
           }else{
               var total = [];
                this.postServices.push({
                    service_id : this.service_id,
                    service: this.service_name,
                    price: this.service_price * this.quantity,
                    quantity: this.quantity
                });
                this.quantity = '';
                $("#enterQuantity").modal('hide');

                this.postServices.forEach(details => {
                    total.push(details.price)
                    
                    document.getElementById('payBtn').removeAttribute("disabled");
                });

                this.subtotal =  total.reduce(function(total, num){ 
                    return total + num 
                }, 0);
           }
            
        },
        fetchCustomer(){
            this.customers = [];
            axios.get('api/customers').then(({data})=>{
                data.forEach(element => {
                    this.customers.push({id: element.id, title: element.name})
                });
            });
        },
        PrintTransaction() {
            if(this.postServices.length < 1){
                this.$toastr.e("Please pick services first.", "Empty");
            }else{
                $("#paymentModal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            
            this.amountRendered = 0;
            this.change = 0;
        },
        saveTransaction(){
            if(this.amountRendered < 1){
                this.$toastr.e("Please put payment first!", "Empty Payment");
                return;
            }
            
            axios.post('/api/transactions/create/savetransaction', {
                services: this.postServices,
                transaction_number: this.transaction_number,
                customer : this.selected,
                amountRendered: this.amountRendered,
                change: this.change
            }).then(({data})=>{
                this.postServices = [];
                this.selected ='';
                this.subtotal = 0;
                
                let routeData = this.$router.resolve({path: '/receipt/' + data.id});
                window.open(routeData.href, '_blank');    
                
            });

        },
        removeItem(index){
            var total = [];
             if(this.postServices.length == 1){
                document.getElementById('payBtn').disabled = true;
                this.$delete(this.postServices,index);
                this.postServices.forEach(details => {
                    total.push(details.price * details.quantity)
                });

                this.subtotal =  total.reduce(function(total, num){ 
                    return  num - total
                }, 0);

            }else{
                this.$delete(this.postServices,index);
                this.postServices.forEach(details => {
                    total.push(details.price * details.quantity)
                });

                this.subtotal =  total.reduce(function(total, num){ 
                    return  num - total
                }, 0);

            }
           
                
    

        }
       
    },
    mounted(){
        this.service();
        this.fetchCustomer();
    }
}
</script>
<style scoped>
   @import url('https://fonts.googleapis.com/css?family=BioRhyme|Roboto&display=swap');

   #receiptContainer{
       font-family: 'BioRhyme', serif;
   }
   .btn-active{
       background-color: red !important; 
   }
   .btn-red{
       background-color: #EF5B5B;
   }
   .nav-pills .active{
       color:white !important;
       letter-spacing: 2px !important;
       border: 2px solid green;
       text-transform: uppercase;
   }
   .productModal{
       max-height: 1000px !important;
   }
</style>