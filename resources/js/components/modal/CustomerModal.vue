<template>
    <form @submit.prevent="editMode ? updateCustomer() : addCustomer()">
        <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ (editMode) ? `Edit ${customerDetails.cname}` : 'Add Customer' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="cname">Name</label>
                                <input type="text" v-model="customerDetails.cname"  class="form-control" id="cname" placeholder="Customer Name">
                            </div>
                            <div class="form-group">
                                <label for="cnumber">Contact Number</label>
                                <input type="number" v-model="customerDetails.cnumber" class="form-control" placeholder="e.g 09123456789">
                            </div>
                            <div class="form-group">
                                <label for="caddress">Address</label>
                                <textarea class="form-control" v-model="customerDetails.caddress" placeholder="Enter Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> {{ (editMode) ? 'Update' : 'Save' }} </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data(){
        return {
            customerDetails: {
                cid : '',
                cname : '',
                cnumber : '',
                caddress : ''
            },
            editMode: false,
        }
    },
    methods: {
        addCustomer(){
            axios.post('/api/customers', {
                    cname : this.customerDetails.cname,
                    cnumber: this.customerDetails.cnumber,
                    caddress: this.customerDetails.caddress
            }).then(() => {
                this.customerDetails.cname ='';
                this.customerDetails.cnumber = '';
                this.customerDetails.caddress = '';
                this.$emit('successCreated');
                this.$toastr.s("Successfully Created");
                $("#addCustomer").modal('hide');
            })
        },
        fetchCustomer(id){
            axios.get('/api/customers/'+id).then(({data}) => {
                this.editMode = true;
                this.customerDetails.cid = data.id;
                this.customerDetails.cname = data.name;
                this.customerDetails.cnumber = data.contact_number;
                this.customerDetails.caddress = data.address1;
                $("#addCustomer").modal('show');
            });
        },
        updateCustomer(){
            axios.put('/api/customers/'+this.customerDetails.cid, {
                cname : this.customerDetails.cname,
                cnumber: this.customerDetails.cnumber,
                caddress: this.customerDetails.caddress
            }).then((data) => {
                this.$emit('successCreated');
                this.$toastr.s("Successfully Updated");
                $("#addCustomer").modal('hide');
            })
        }
    }
}
</script>