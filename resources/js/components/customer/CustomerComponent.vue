<template>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Management</h3>
                <div class="card-tools">
                  <button class="btn btn-success rounded-0" @click="addCustomerModal"> <i class="fa fa-plus" aria-hidden="true"></i> Add Customer</button>
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
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> -->
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
            customers: {}
        }
    },
    methods : {
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