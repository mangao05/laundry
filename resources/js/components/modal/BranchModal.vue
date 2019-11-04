
<style scoped>

</style>

<template>
    <div class="modal fade " id="branchModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                             <h5 class="modal-title">Add Branch </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body p-4" style="letter-spacing:2px;">
                        <label for="">Branch code</label>
                        <input type="text" class="form-control" v-model="form.branch_code" placeholder="Enter Branch code" :class="{ 'is-invalid': form.errors.has('branch_code') }">
                          <has-error :form="form" field="branch_code"></has-error>
                        <br>
                        <label for="">Branch Address</label>
                        <input type="text" class="form-control" v-model="form.address" placeholder="Address" :class="{ 'is-invalid': form.errors.has('address') }">
                        <has-error :form="form" field="address"></has-error>
                </div>
             <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="editMode === true ? updateBranch() : saveBranch()" class="btn btn-primary">{{ editMode === true ? "Update" : "Confirm Branch" }}</button>
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
                // roleCreated : {},
                form: new Form({
                    branch_id:'',
                    branch_code:'',
                    address:'',
                })
            }
        },
        methods:{
             saveBranch(){
                this.form.post('api/branch').then(({data}) => {
                    // this.servicesCreated = data;
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Register Successfully'
                    })
                    $("#branchModal").modal('hide');
                    this.$emit('BranchCreated')
                }).catch(()=>{
                });
            },
            updateBranch(){
                this.form.put('api/branch/'+this.form.branch_id).then((data) => ( this.$emit('createdSuccess') ))
            },
        },
        created(){
            Fire.$on('editmode', (data) => {
                this.editMode = true;
                this.form.branch_id = data.id
                this.form.branch_code = data.branch_code
                this.form.address = data.branch_address

            });
        }
    }
</script>
