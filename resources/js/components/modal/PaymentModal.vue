<template>
    <div class="modal fade " id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-dark p-4 ">
                <div class="modal-body">
                   <keyboard @closeModal="closeModal()" ></keyboard>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import KeysWithInput from '../keyboard/NumberKeysComponent.vue';
export default {
    components : {
        'keyboard': KeysWithInput
    },
    data(){
        return {

        }
    },
    methods: {
        closeModal(){
            $('#paymentModal').modal('hide')
            
        },
        returnAmount(amount){
            $('#paymentModal').modal('hide')
            this.$parent.amountRendered = amount;
        }
    }
}
</script>