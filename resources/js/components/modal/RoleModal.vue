
<style scoped>

</style>

<template>
    <div class="modal fade " id="roleModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                             <h5 class="modal-title">Add Role To User </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body text-center p-4" style="letter-spacing:1px;">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="form.role_name" placeholder="Input role for user ..." :class="{ 'is-invalid': form.errors.has('role_name') }">
                        <select v-model="form.role_type"    :class="{ 'is-invalid': form.errors.has('role_type') }">
                            <option value="" selected disabled>Select Job Role</option>
                            <option value="Water">Water</option>
                             <option value="Laundry">Laundry</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" @click="editMode === true ? updaterole() : saveRole()" class="btn btn-primary">{{ editMode === true ? "Update" : "Confirm" }}</button>
                        </div>
                          <has-error :form="form" field="role_name"></has-error>
                        <has-error :form="form" field="role_type"></has-error>
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
                editMode: false,
                roleCreated : {},
                form: new Form({
                    role_id:'',
                    role_name:'',
                    role_type:'',
                })
            }
        },
        methods:{
            saveRole(){
                this.form.post('api/role').then(({data}) => {
                    this.roleCreated = data;
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Register Role Successfully'
                    })
                     $("#roleModal").modal('hide');
                    this.$emit('RoleCreated')
                }).catch(()=>{
                });
            },
             updaterole(){
                this.form.put('api/role/'+this.form.role_id).then((data) => (
                     Toast.fire({
                        type: 'success',
                        title: 'Role Successfully Updated'
                    })
                 ))

            },
        },
        created(){
            Fire.$on('editRoleMode', (data) => {
                this.editMode = true;
                this.form.role_id = data.id
                this.form.role_name =data.role
            });

        }
    }
</script>
