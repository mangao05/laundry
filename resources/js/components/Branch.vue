<template>
    <div class="container">
      <h3 class="card-title">Branch Management</h3>

           <span  @click="openbranchmodal()"   class="badge badge-success p-2 m-2 ml-auto float-right" style="font-size:20px;">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Branch
            </span>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tbody  class="text-center" style="letter-spacing:1px;">
                        <tr>
                            <th>#</th>
                            <th>Branch code</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                         <tr v-show="branch.length == 0">
                            <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No Data Found</i></td>
                        </tr>
                        <tr v-for="(branches, index) in branch" :key = "branches.id"  >
                            <td>{{ index + 1 }}</td>
                            <td>{{ branches.branch_code }}</td>
                            <td>{{ branches.branch_address }}</td>
                            <td>
                               <span class="badge badge-primary p-2" @click = "editBranch(branches.id)" >Edit</span>
                                <span class="badge badge-danger p-2" @click = "deleteBranch(branches.id)">Delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    <BranchModal @BranchCreated="branchload"></BranchModal>
    </div>
</template>

<script>
    export default {
         data(){
            return {
                  branch:{},
                  branchdata:{},
                form : new Form({})
            }
        },
        methods:{
             openbranchmodal(){
                  $("#branchModal").modal('show');

            },
             loadBranch(){
              axios.get('api/branch').then(({data}) => {
                    this.branch = data
                    
                })
            },
             editBranch(id){
                axios.get('api/branch/'+id).then((data) => {
                    this.branchdata = data.data
                    Fire.$emit('editmode', this.branchdata);
                    $("#branchModal").modal('show');
                    this.loadBranch();
                });
            },
             deleteBranch(id){
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
                    this.form.delete('api/branch/'+id).then(()=>{
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                     this.loadBranch();
                    }).catch(()=>{

                    });

                }
                })
            },
            branchload(){
                this.loadBranch();
            },
        },

        created: function(){
             this.loadBranch();
        },
    }
</script>
