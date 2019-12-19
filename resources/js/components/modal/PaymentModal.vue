<template>
    <div class="modal fade " id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-dark p-4 ">
                <div class="modal-body">
                   <keyboard @closeModal="closeModal()" :options="options" :amount="subtotal"></keyboard>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import KeysWithInput from '../keyboard/NumberKeysComponent.vue';
export default {
    props: ['subtotal'],
    components : {
        'keyboard': KeysWithInput
    },
    data(){
        return {
            options : {
                number_only: false,
                label: 'Enter Amount'
            }
        }
    },
    methods: {
        closeModal(){
            $('#paymentModal').modal('hide')
            this.$parent.$data.isDisabled = true;
            this.$parent.$data.change = '0';
            
        },
        returnAmount(amount){

            if(amount < 0 || amount == ""){
                this.$toastr.e("Please input amount.", "Empty");
                return;
            }
           
            if(this.subtotal > amount){
                this.$toastr.e("Please pay exact or higher amount.", "Error Amount");
                return;
            }

            $('#paymentModal').modal('hide')
            this.$parent.amountRendered = amount;
            this.$parent.$data.isDisabled = false;
            this.$parent.$data.change = amount - this.subtotal;
        }
    }
}
</script>