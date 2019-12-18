<style scoped>
    .nav-link{
        cursor: pointer !important;
    }
    .active {
        font-weight: bold !important;
        color: blue !important;
    }
</style>


<template>
    
    <div class="row">
        
        <div class="col-8 mt-2">
            <div class="card" style="height:270px;" >
                <div class="card-title text-center bg-dark">
                   <span style="font-size:30px;" >Total Sale</span>
                </div>
                <div class="card-body mt-4">
                    <div class="row text-center">
                         <div class="col-6 mt-3" style="line-height:20px;" >
                               <span style="font-size:80px; font-weight:bold;" >{{ state.date | moment("DD")}}</span>
                               <br>
                               <span>{{ state.date | moment("MMMM")}}</span>
                                <input  id="currentDate"  type="hidden" :value="state.date | moment('DD/MM/YYYY')">
                    
                        </div>
                        <div class="col-6 " style="border-left:2px solid black;">
                                <span v-if="loading" > <Gauge class="mt-4 mx-auto "></Gauge></span>
                                <span v-else style="font-size:45px; font-weight:bold;">{{  totalClient  }}</span>
                        </div>  
                    </div>  
                </div>
                  <div class="card-footer bg-transparent border-dark">
                      <div class="row text-center" style="font-weight:bold;">
                          <div class="col-6 ">
                             <span > Date</span>
                          </div>
                          <div class="col-6">
                              Total  Laundry 
                          </div>
                      </div>
                  </div>
            </div>
        </div>
         <div class="col-4 mb-4">
             <div class=" px-5 ">
                   <datepicker v-model="state.date"  @input="selectedDate()" calendar-class="w-100  border-danger rounded-lg " :inline="true" ></datepicker>
             </div>
         
        </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" :class="(finishActive) ? 'active' : ''" @click = "transactionsType('all')">All </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " :class="(voidActive) ? 'active' : ''" @click = "transactionsType('void')">For PickUp</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" :class="(cancelActive) ? 'active' : ''" @click = "transactionsType('cancel')">Delivered</a>
                    </li>
                </ul>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Transaction #</th>
                      <th>Customer</th>
                      <th>Type</th>
                      <th>Pickup Date</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-show = "transactions.length == 0">
                        <td colspan="7" class="text-center font-weight-bold" > <i> No Record Yet...</i></td>
                    </tr>

                    <tr v-if="loading" >
                        <td colspan="7" > 
                            <HourGlass style="margin-left:500px;"></HourGlass>
                           
                        </td>
                    </tr>

                    <tr v-else v-for = "(transaction, index) in transactions" :key = "transaction.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ "Laundry_"+transaction.transaction_number }}</td>
                      <td class="text-capitalize">{{ transaction.customers.Name }}</td>
                      <td>{{ transaction.mode }}</td>
                      <td>{{ (transaction.mode == 'Deliver') ? 'N/A' : transaction.pickup_date }}</td>
                      <td>{{ transaction.status }}</td>
                      <td>
                          <span class="badge badge-success rounded-0 text-white p-2" style="cursor: pointer" @click = "viewReceipt(transaction.transaction_number)"> <i class="fa fa-eye"></i> View</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <review-modal :customer_points = "customer_points" :transaction_customer = "transaction_customers" :transaction_number = "transaction_number" :transaction_details = "transaction_details" :subtotal = "subtotal"></review-modal>
        </div>
</template>
<script>
import moment from 'moment';
import {HourGlass,Gauge} from 'vue-loading-spinner';

export default {
      components: {
      HourGlass,
      Gauge
    },
    data(){
        return {
            loading: true,
            transactions : {},
            finishActive : false,
            voidActive: false,
            cancelActive : false,
            type: 'all',
            transaction_number : '',
            transaction_details : {},
            transaction_customers : {},
            subtotal : '',
            customer_points : {},
            state:{
                date: new Date()
                },
            currentdate:0,
            totalClient:0,
      
           
        }
    },
    methods: {
        transactionsType(type){
            this.type = type
            if(type == 'all'){
                this.cancelActive = false
                this.voidActive = false
                this.finishActive = true
            }else if(type == 'void'){
                this.finishActive = false
                this.voidActive = true
                this.cancelActive = false
            }else{
                this.cancelActive = true
                this.voidActive = false
                this.finishActive = false
            } 

           
            axios.get('api/transactionsDetails/type/'+ type).then(({data}) => {
                this.transactions = data.data;
                console.log(  this.transactions );
                  this.loading = false 
                 
            })
       
        },
        selectedDate(){
             var date = moment(this.state.date).format('YYYY-MM-DD');
             axios.get('api/gettingDate/'+ date +'/'+ this.type).then(({data}) => {
                 this.totalClient = data.total
                 this.transactions = data.data
                 this.loading = false
                 console.log(data.total)     
            })
            
        },

        viewReceipt(id){
            let total = [];
            $("#reviewModal").modal('show')
            this.transaction_number = "Laundry_"+id
            axios.get('api/transactionDetails/'+this.transaction_number).then(({data}) => {
                this.transaction_details = data.transaction_details
                this.transaction_customers = data.customers
                this.customer_points = data.customers.customer_points
                 data.transaction_details.forEach(details => {
                    Object.entries(details.transaction_items).forEach(([key, val]) => {
                        total.push(val.price)
                        });
                    });
                    this.subtotal =  total.reduce(function(total, num){ return total + num }, 0);
            });
        }
    },
    created(){
       this.transactionsType(this.type);
    },
}
</script>