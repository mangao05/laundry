<template>
    <div class="container">
      <h6>User Role</h6>

          
            <div class="row">
                  <div class="col-9">
                    <span  @click="openrolemodal()"  class="badge badge-success p-2 m-2 ml-auto float-left" style="font-size:20px;">
                        <i class="fas fa-user-cog    "></i> Add Role Name
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
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                         <tr v-show="role.length == 0">
                            <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No Data Found</i></td>
                        </tr>
                        <tr  v-for="(roles, index) in role" :key = "roles.id" >
                            <td>{{ index+1 }}</td>
                            <td>{{ roles.role  }}</td>
                            <td>
                                 <span class="badge badge-primary p-2" @click = "editRole(roles.id)" >Edit</span>
                                <span class="badge badge-danger p-2" @click = "deleteRole(roles.id)">Delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <RoleModal @RoleCreated="Roleload"></RoleModal>
    </div>
</template>

<script>
    export default {
         data(){
            return {
                role:{},
                roledata:{},
                form : new Form({}),
                searchOptions : {
                    table : 'roles',
                    column : 'role'
                }
            }
        },
        methods:{
            search(e){
            this.role = e;
            },
            openrolemodal(){
                  $("#roleModal").modal('show');
            },
            loadRole(){
              axios.get('api/role').then(({data}) => {
                    this.role = data
                })
            },
            editRole(id){
                axios.get('api/role/'+id).then((data) => {
                    this.roledata = data.data
                    Fire.$emit('editRoleMode', this.roledata);
                    $("#roleModal").modal('show');
                    this.loadRole();
                });
            },
             deleteRole(id){
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
                    this.form.delete('api/role/'+id).then(()=>{
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        this.loadRole();
                    }).catch(()=>{

                    });

                }
                })
            },
            Roleload(){
                  this.loadRole();
            }
        },

        created: function(){
             this.loadRole();
        },
    }
</script>
