<template>
<div class="container border border-secondary p-3 mb-3" id="receiptContainer" style="height: 115vh; ">
    <div class="row">
        <div class="col-lg-4 " style="border-right: 1px solid black; ">
                <v-select
                    v-model = "selected"
                    label="name"
                    :options="customers"
                    item-text = "name"
                    item-value = "_id"
                    required
                    placeholder= "Select Customer"
                    @input="customer = selected.name"
                >
                </v-select>
            
            <div id="PrintTransaction">
                <div class="text-center">
                    <h3>Receipt #: {{ transaction_number }}</h3>
                    <h2> <i class="fas fa-user"></i> {{ customer }}</h2>
                </div>
            <div style="height: 60vh; border-bottom: 1px solid black; overflow-y: auto;" class="mb-2">
                <table class="table table-light table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Unit/Qty</th>
                            <th>Price</th>
                            <td class="text-danger">x</td>
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
            <table class="table">
                <tbody>
                    <tr>
                        <td colspan="3">
                            <span class="h2">Total:</span>
                        </td>
                        <td class="text-right">
                            <span class="h2">₱{{ subtotal }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="h4">Cash Received:</span>
                        </td>
                        <td class="text-right">
                            <span class="h4">₱{{ CashReceived }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="h5">Change</span>
                        </td>
                        <td class="text-right">
                            <span class="h5">₱{{ change }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
               
            </div>
             <div class="col-12 text-right mt-5">
                <button id="payBtn" class="btn btn-success" @click="openAmountModal" disabled><i class="fas fa-dollar-sign    "></i> Pay Now</button>
            </div>
           
           

 


            <!-- End COlumn -->
        </div>
        <div class="col-lg-8">
            <h1 class="text-uppercase text-danger font-weight-bold text-center" style="text-decoration: underline; font-stretch:expanded; font-family: 'Oswald', sans-serif;" ><i>bullseye laundry</i></h1>
            <hr style="border: 2px solid black;">
            <div class="row">
                <div class="col-6 text-right">
                    <button class="btn btn-dark p-3" :class="(dryActive) ? 'btn-active' : ''" @click="service('item')">Dry Clean</button>
                </div>
                <div class="col-6">
                   <button class="btn btn-dark p-3" :class="(!dryActive) ? 'btn-active' : ''" @click="service('kilo')">Assorted Clothes</button>
                </div>
            </div>
            <div class="row justify-content-center m-3">
                <div v-for="service in services.data" :key="service.id"  class="col-lg-4">
                    <button class="btn btn-info btn-block m-2" style="min-height:150px;" @click="openQuantityModal(service.id, service.service, service.price)">
                         <span class="text-uppercase">{{ service.service }}</span> <br>
                         <span class="font-weight-bold">{{ service.price }} {{ (service.type == 'item') ? '/ pc' : '/ kg' }}</span>
                    </button>
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
 
  

    <div class="modal fade" id="enterQuantity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ service_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="quantity" class="col-form-label">Quantity/Kilo</label>
                    <input type="number" class="form-control" id="quantity" v-model="quantity">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="storeService()">Submit</button>
            </div>
            </div>
        </div>   
    </div>

      <div class="modal fade" id="enterAmount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Enter Exact Amount Recieved</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="quantity" class="col-form-label">Amount Rendered</label>
                    <input type="number" class="form-control" id="quantity" v-model="amountRendered">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="paymentTransaction">Submit</button>
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
            amountRendered:'',
            CashReceived:'0',
            change:'0',
            transaction_number: '0000',
            page: 2,
            serviceType : 'item',
            pageCount: 0,

        }
    },
    methods: {
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
            $("#enterQuantity").modal('show');
            
        },
        storeService(){     
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
                    total.push(details.price * details.quantity)
                    
                    document.getElementById('payBtn').removeAttribute("disabled");
                });

                this.subtotal =  total.reduce(function(total, num){ 
                    return total + num 
                }, 0);

                console.log(this.subtotal);

        },
        fetchCustomer(){
            this.customers = [];
            axios.get('api/customers').then(({data})=>{
                data.forEach(element => {
                    this.customers.push({ _id : element.id , name: element.name })
                });
            });
        },
        PrintTransaction() {
            
            this.$htmlToPaper('PrintTransaction', () => {
                axios.post('/api/transactions/create/savetransaction', {
                    services: this.postServices,
                    transaction_number: this.transaction_number,
                    customer_id : this.selected._id,
                }).then(({data})=>{
                        this.postServices = [];
                        this.selected ='';
                        this.subtotal = '';
                        
                });
            });
        },
        openAmountModal(){
           
            if(this.selected != ''){
                $("#enterAmount").modal('show');
            }else{
                alert('Pick Customer');
            }
        },
        paymentTransaction(){
            // window.open(routeData.href, '_blank');
            // this.CashReceived = this.amountRendered

            if(this.subtotal  <=  this.CashReceived){
                this.change = this.CashReceived - this.subtotal  ;
            
                Swal.fire({
                    title: 'Are you sure about this Transaction?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Print it!'
                    }).then((result) => {
                    if (result.value) {
                        
                        $("#enterAmount").modal('hide');
                        this.PrintTransaction();
                      
                    }
                    })
                
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'The amount given is Short!',
                })
                    this.CashReceived = 0;
            }
            console.log(this.CashReceived);
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
</style>