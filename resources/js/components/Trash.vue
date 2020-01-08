<template>
    <div >
        <h5>Deleted Files</h5>
        <div class="row">
            <div class="col-9">
                 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#user" @click="modules('users')" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#branch"  @click="modules('branches')" role="tab" aria-controls="pills-profile" aria-selected="false">Branch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#service"  @click="modules('services')" role="tab" aria-controls="pills-contact" aria-selected="false">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#customer"  @click="modules('customers')" role="tab" aria-controls="pills-contact" aria-selected="false">Customer</a>
                    </li>
                </ul>
            </div>
            <div class="col-3 " >
                <div class="input-group flex-nowrap">
                      <input type="search" v-model="search" id="" class="form-control" placeholder="Search"  @input="searchTrash()">
                    <div class="input-group-prepend">
                         <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search" aria-hidden="true"></i></span> 
                    </div>
                   
                </div>
                 
            </div>
        </div>
       

          

            <!-- user -->
                <div class="tab-content " id="pills-tabContent"  >
                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-dark">   
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody  class="text-center" style="letter-spacing:1px;">
                                   
                                    <tr v-show="user.length == 0">
                                        <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No User Found</i></td>
                                    </tr>
                                    <tr v-for="(users, index) in user" :key = "users.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ users.name  }}</td>
                                        <td>{{ users.email }}</td>
                                        <td>{{ users.user_type }}</td>
                                        <td>{{ users.branch }}</td>
                                        <td>
                                            <span class="badge badge-info p-2" @click = "restore('users',users.id)">Restore</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- branch -->
                    <div class="tab-pane fade" id="branch" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered">
                                  <thead class="bg-dark">    
                                        <tr>
                                            <th>#</th>
                                            <th>Branch code</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                  </thead>
                                  
                                <tbody  class="text-center" style="letter-spacing:1px;">
                                    <tr v-for="(branches, index) in branch" :key = "branches.id"  >
                                        <td>{{ index+1 }}</td>
                                        <td>{{ branches.branch_code }}</td>
                                        <td>{{ branches.branch_address }}</td>
                                        <td>
                                            <span class="badge badge-info p-2" @click = "restore('branches',branches.id)">Restore</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>       
                        </div>
                     
                
                    </div>
                    <!-- service -->
                    <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-bordered">
                                    <thead class="bg-dark">    
                                        <tr>
                                            <th>#</th>
                                            <th>Service</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Minimum</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody  class="text-center">
                                        <tr v-show="services.length == 0">
                                            <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No items Found</i></td>
                                        </tr>

                                        <tr v-for="(service, index) in services" :key = "service.id">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ service.service }}</td>
                                            <td>{{ service.price }}</td>
                                            <td>{{ service.type }}</td>
                                            <td>{{ service.minimum }}</td>
                                            <td>
                                                <span class="badge badge-info p-2" @click = "restore('services',service.id)">Restore</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                     <!-- customer -->
                    <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="pills-contact-tab">
                    
                                <table class="table table-bordered table-hover ">
                                    <thead class="bg-dark">                  
                                        <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody  class="text-center">
                                        <tr v-for="(customer, index) in customers" :key="customer.id">
                                        <td>{{ index + 1 }}.</td>
                                        <td>{{ customer.name }}</td>
                                        <td>{{ (!customer.address1) ? 'None' : customer.address1 }}</td>
                                        <td>
                                           <span class="badge badge-info p-2" @click = "restore('customers',customer.id)">Restore</span>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                     </div>


                </div>
    </div>
    
</template>
<style>
    
</style>
<script>
    export default {
        props: ['options'],
         data(){
            return {
                branch:{},
                user:{}, 
                services:{},
                customers:{},
                search:'',
                mod:'users',
            }
        },
        methods:{
             loadUser(){
                axios.get('api/trashuser').then(({data}) => {
                    this.user = data
                })
            },
             loadBranch() {   
              axios.get('api/trashbranch').then(({data}) => {
                    this.branch = data       
                })
            },
             loadServices(){
                axios.get('api/trashservices').then(({data}) => {
                    this.services = data
               
                })
            },
            loadCustomers(){
                axios.get('/api/trashcustomer').then(({data}) => {
                    this.customers = data
                });
           
            },
            restore(table,id){
                axios.post('/api/restorefile', {
                    table : table,
                    id : id,
                    }).then(({data}) => {
                        this.$toastr.s('Successfully Restore');
                        if(data == 'users'){
                                    this.loadUser();
                        }else if(data == 'branches'){
                                this.loadBranch();
                        }else if(data == 'services'){
                                    this.loadServices();
                        }else if (data == 'customers'){
                                this.loadCustomers();
                        }else{
                                this.$toastr.e('Error');
                        }
                    })
            },
            searchTrash(){
                    axios.post('/api/searchfile', {
                        table : this.mod,
                        search : this.search,
                    }).then(({data}) => {
                        this.user = data
                        this.branch = data   
                        this.services = data    
                        this.customers = data
                    })
            },
            modules(val){
               this.mod = val ;
               this.search = '';
               if(val == 'users'){
                     this.loadUser();
                }else if(val == 'branches'){
                        this.loadBranch();
                }else if(val == 'services'){
                            this.loadServices();
                }else if (val == 'customers'){
                        this.loadCustomers();
                }else{
                        this.$toastr.e('Error');
                }
             
            }
            
        },
        created: function(){
            this.loadUser();
            this.loadBranch();
            this.loadServices();
            this.loadCustomers();
        },
    }
</script>
