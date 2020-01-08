<template>
    <div class="card">
              <div class="card-header">
             
                <h5>Customer Management</h5>

                <div class="row">
                  <div class="col-9">
                    <div class="card-tools">
                      <button class="btn btn-success rounded-0" @click="addCustomerModal"> <i class="fa fa-plus" aria-hidden="true"></i> Add Customer</button>
                    </div>
                  </div>
                  <div class="col-3">
                      <search :options="searchOptions" @searchSuccess="search"></search>   
                  </div>
                </div>
               
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead class="bg-dark">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(customer, index) in customers" :key="customer.id">
                      <td>{{ index + 1 }}.</td>
                      <td>{{ customer.name }}</td>
                      <td>{{ (!customer.address1) ? 'None' : customer.address1 }}</td>
                      <td>
                        <!-- <button class="btn btn-primary btn-sm rounded-0" @click="openViewM"> <i class="fa fa-eye" aria-hidden="true"></i>View</button> -->
                        <button @click="editCustomerModal(customer.id)" class="btn btn-info btn-sm rounded-0"> <i class="fa fa-pencil-alt" aria-hidden="true"></i>Edit</button>
                        <button class="btn btn-danger btn-sm rounded-0" @click="deleteCustomer(customer.id)"> <i class="fa fa-times" aria-hidden="true"></i> Delete</button>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
  
              <add-customer ref="customerModal" @successCreated="loadCustomers"></add-customer>
            </div>
            
</template>
<script>
import AddCustomer from '../modal/CustomerModal.vue';
export default {
    components: {
        'add-customer' :  AddCustomer
    },
    data(){
       
        return {
            customers: {},
            searchOptions : {
              table : 'customers',
              column : 'name'
            }
        }
    },
    methods : {
        search(e){
          this.customers = e;
        },
        addCustomerModal(){
            this.$refs.customerModal.$data.editMode = false;
            this.$refs.customerModal.$data.customerDetails.cname = '';
            this.$refs.customerModal.$data.customerDetails.cnumber = '';
            this.$refs.customerModal.$data.customerDetails.caddress = '';
            $("#addCustomer").modal('show');
        },
        loadCustomers(){
            axios.get('/api/customers').then(({data}) => {
                this.customers = data
            });
        },
        editCustomerModal(id){
            this.$refs.customerModal.fetchCustomer(id);
        },
        deleteCustomer(id){
            axios.delete('/api/customers/'+id).then(({data}) => {
                this.loadCustomers();
                this.$toastr.e("Deleted Successfully");
            })
        }
    },
    created(){
        this.loadCustomers();
    }
}
</script>