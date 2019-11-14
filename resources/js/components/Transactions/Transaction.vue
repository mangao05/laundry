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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" :class="(finishActive) ? 'active' : ''" @click = "transactionsType('finish')">Finish Transactions</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " :class="(voidActive) ? 'active' : ''" @click = "transactionsType('void')">Void Transactions</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" :class="(cancelActive) ? 'active' : ''" @click = "transactionsType('cancel')">Cancelled Transactions</a>
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
                    <tr v-for = "(transaction, index) in transactions" :key = "transaction.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ "Laundry_"+transaction.transaction_number }}</td>
                      <td class="text-capitalize">{{ transaction.customers.name }}</td>
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
export default {
    data(){
        return {
            transactions : {},
            finishActive : false,
            voidActive: false,
            cancelActive : false,
            type: 'finish',
            transaction_number : '',
            transaction_details : {},
            transaction_customers : {},
            subtotal : '',
            customer_points : {},
        }
    },
    methods: {
        transactionsType(type){
            this.type = type
            if(type == 'finish'){
                this.cancelActive = false
                this.voidActive = false
                this.finishActive = true
            }else if(type == 'void'){
                this.finishActive = false
                this.voidActive = true
            }else{
                this.cancelActive = true
                this.voidActive = false
                this.finishActive = false
            }
            axios.get('api/transactionsDetails/type/'+ type).then(({data}) => {
                this.transactions = data.data
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