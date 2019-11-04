
<style scoped>
    .reg_head {
    overflow: hidden;
    text-align: center;
    }

    .reg_head:before,
    .reg_head:after {
    background-color:gray;
    content: "";
    display: inline-block;
    height: 1px;
    position: relative;
    vertical-align: middle;
    width: 25%;
    }

    .reg_head:before {
    right: 0.5em;
    margin-left: -50%;
    }

    .reg_head:after {
    left: 0.5em;
    margin-right: -50%;
    }

</style>

<template>
    <div class="modal fade " id="userModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body text-center" style="letter-spacing:1px;">
                   <h3 class="reg_head text-secondary">Register User</h3>
                   <span class="text-secondary">Create the Account of your Employee Here</span>
                   <div class="row  mt-4">
                       <div class="col-md-6 ">
                            <div class="input-group mb-3 ">
                            <div class="input-group-prepend ">
                                <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa fa-user nav-icon" aria-hidden="true"></i></span>
                            </div>
                                 <input type="text"  v-model="form.fname" :class="{ 'is-invalid': form.errors.has('fname') }" class="form-control" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1">
                                <has-error :form="form" field="fname"></has-error>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa fa-user nav-icon" aria-hidden="true"></i></span>
                            </div>
                                 <input type="text" v-model="form.lname"  :class="{ 'is-invalid': form.errors.has('lname') }" class="form-control" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1">
                             <has-error :form="form" field="lname"></has-error>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                                 <input type="text"  v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                            <has-error :form="form" field="email"></has-error>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa fa-key nav-icon" aria-hidden="true"></i></span>
                            </div>
                                 <input type="password"  v-model="form.password"  :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                            <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>

                         <div class="col-md-12 mb-3">
                            <select class="custom-select" v-model="form.branch"   :class="{ 'is-invalid': form.errors.has('type') }">

                                <option disabled value="" selected>Assign Branch</option>
                                <option  v-for="branch in branches" :key = "branch.id" :value="branch.branch_code " >{{ branch.branch_address }}</option>
                            </select>
                        <has-error :form="form" field="type"></has-error>
                        </div>

                        <div class="col-md-12">
                            <select class="custom-select" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option disabled value="" selected>Select Type of Employee</option>
                                <option v-for="roles in role" :key = "roles.id"  :value="roles.role">{{ roles.role }}</option>
                            </select>
                        <has-error :form="form" field="type"></has-error>
                        </div>
                   </div>
                </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="editMode === true ? updateUser() : saveUser()" class="btn btn-primary">{{ editMode === true ? "Update" : "Register" }}</button>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
    export default {
        data(){
            return {
                editMode: false,
                role:{},
                branches:{},
                form: new Form({
                    user_id:'',
                    fname:'',
                    lname:'',
                    email:'',
                    password:'',
                    type:'',
                    branch:'',
                })
            }
        },
        methods:{
            saveUser(){
                this.form.post('api/UserManagement').then(({data}) => {
                    // this.servicesCreated = data;
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Register Successfully'
                    })
                          $("#userModal").modal('hide');
                           this.$emit('userSuccess')
                }).catch(()=>{
                });
            },
            updateUser(){
                this.form.put('api/UserManagement/'+this.form.user_id).then((data) => ( this.$emit('createdSuccess') ))
            },

        },
        created(){
            //role
             Fire.$on('roledata', (data) => {
                    this.role = data

            });
            //branch
            Fire.$on('branchdata', (data) => {
                this.branches = data
            });

            Fire.$on('editmode', (data) => {
                 this.editMode = true;
                 this.form.fill(data)
                this.form.user_id = data.id
                this.form.type = data.user_type
            });
        }
    }
</script>
