<template>
    <div class="container">
        <h5>User Management</h5>

            <div class="row">
                  <div class="col-9">
                     <span  @click="openusermodal()"  class="badge badge-success p-2 m-2 ml-auto float-left" style="font-size:20px;">
                         <i class="fa fa-user-plus nav-icon" aria-hidden="true"></i> Add User
                    </span>
                  </div>
                  <div class="col-3">
                      <search :options="searchOptions" @searchSuccess="search"></search>   
                  </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody  class="text-center" style="letter-spacing:1px;">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr v-show="user.length == 0">
                            <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No User Found</i></td>
                        </tr>
                        <tr v-for="(users, index) in user" :key = "users.id">
                            <td>{{ index+1 }}</td>
                            <td>{{ users.name  }}</td>
                            <td>{{ users.email }}</td>
                            <td>{{ users.user_type }}</td>
                            <td>{{ users.branch }}</td>
                            <td class="text-success" v-if="users.status ==='Activate'">  <span  @click = "userStatus(users.id,users.status)" >{{ users.status }}</span></td>
                             <td class="text-danger" v-if="users.status !='Activate'">  <span  @click = "userStatus(users.id,users.status)" >{{ users.status }}</span></td>
                             <td>
                                <span class="badge badge-primary p-2" @click = "editUser(users.id)" >Edit</span>
                                <span class="badge badge-danger p-2" @click = "deleteUser(users.id)">Delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <UserModal @userSuccess = "userload"></UserModal>
    </div>
</template>

<script>
    export default {
         data(){
            return {
                user:{},
                userdata:{},
                branch:{},
                role:{},
                form : new Form({}),
                searchOptions : {
                    table : 'users',
                    column : 'name'
                }
            }
        },
        methods:{
            search(e){
            this.user = e;
            },
            openusermodal(){
                  $("#userModal").modal('show');
            },
            loadUser(){
              axios.get('api/UserManagement').then(({data}) => {
                    this.user = data
                })
            },
             loadUserRole(){
              axios.get('api/role').then(({data}) => {
                    this.role = data
                    Fire.$emit('roledata',this.role);
                })
            },
             loadBranch(){
              axios.get('api/branch').then(({data}) => {
                    this.branch = data
                    Fire.$emit('branchdata',this.branch);
                })
            },
             userStatus(id,status){
                axios.get('api/getUser/'+id+'/'+status).then(({data}) => {
                    Toast.fire({
                    type: 'success',
                    title: 'Account Successfully'+' '+ data
                    })
                    this.userload();
                });
            },
             editUser(id){
                axios.get('api/UserManagement/'+id).then((data) => {
                    this.userdata = data.data
                    Fire.$emit('editmode', this.userdata);
                    $("#userModal").modal('show');

                });
            },
            deleteUser(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    this.form.delete('api/UserManagement/'+id).then(()=>{
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                         this.loadUser();
                    }).catch(()=>{

                    });

                }
                })
            },
             userload(){
                this.loadUser();
            },
        },


         created: function(){
            this.loadUser();
            this.loadUserRole();
            this.loadBranch();
        },
    }
</script>
