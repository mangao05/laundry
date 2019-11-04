<style scoped>
    .modal-height{
        /* min-height: 500px !important; */
        overflow-x: auto;
        max-height: 500px;
    }
    
</style>
<template>
       <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
               <div class="modal-content">
                   <div class="modal-header bg-success">
                       <h5 class="modal-title">Review your receipt</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                   </div>
                   <div class="modal-body modal-height">
                        <div class="font-weight-bold h4 text-center">Review Details of {{ transaction_number }}</div>
                       <table class="table table-bordered table-striped table-hover">
                           <thead class="text-center">
                               <tr>
                                    <th style="min-width: 200px;">Service(ITEM)</th>
                                    <th>Price/Unit</th>
                                    <th>Qty/Wgt</th>
                                    <th>Price</th>
                                    <th>Action</th>
                               </tr>     
                           </thead>
                           <tbody  v-for="details in transaction_details" :key = "details.id" style="font-size:12px;">
                                <tr v-for = "items in details.transaction_items" :key ="items.id" class="align-top text-center">
                                    <td scope="row" >{{ (items.service.service == "kilo") ? "Per " + items.service.service  : "Per " +items.service.service + " ( "+ items.item +" ) " }}</td>
                                    <td>{{ "₱"+ items.service.price }}{{ (items.service.type == 'kilo') ? "/kg" : '/pc' }}</td>
                                    <td>{{ (items.service.type == 'kilo') ? items.qty + 'kg': (items.qty > 1 ? items.qty+'pcs' : items.qty+'pc') }}</td>
                                    <td>{{  "₱"+ items.price  }}</td>
                                        <td>
                                            <span class="badge badge-danger rounded-0" style="cursor: pointer;" @click = "removeItem(items.id)">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </td>
                                </tr>
                            </tbody>
                            <tfoot id = "tfoot">
                                <tr style="font-size: 18px;">
                                    <td class="text-right font-weight-bold" colspan="3">Subtotal: </td>
                                    <td class="text-center" colspan="2">{{ "₱" + subtotal }}</td>
                                </tr>
                                <tr style="font-size: 12px;">
                                    <td class="text-right font-weight-bold" colspan="3">Vat incl.(12%)</td>
                                    <td class="text-center" colspan="2">{{ "₱" + subtotal * .12 }}</td>
                                </tr>
                                <tr style="font-size: 20px;">
                                    <td class="text-right font-weight-bold text-uppercase" colspan="3">
                                        <span clas></span>
                                        <i class="fas fa-info-circle" style="color:#227DC7;"  id = "tooltip"  data-toggle="tooltip" data-placement="left" title="Subtotal + Vat"></i>
                                        Grand total 
                                    </td>
                                    <td class="text-center font-weight-bold" colspan="2" >{{ "₱" + grand_total }}</td>
                                </tr>
                                 <tr style="font-size: 12px;">
                                    <td class="text-right font-weight-bold" colspan="3">Points Earned</td>
                                    <td class="text-center" colspan="2">{{  grand_total / 100 }}</td>`
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><span class="font-weight-bold text-uppercase">{{ client_name }}</span> has <span class="font-weight-bold">{{ points }}</span> points. Do you want to use Points? </td>
                                    <td colspan="2">
                                        <button v-show = "!usepoints" class="btn btn-success form-control" @click = "usepoints = true">Yes</button>
                                        <input type="number" v-show = "usepoints" v-model ="points_used" :maxlength="points" class="form-control" :max = "points" @input="computeGrand">
                                    </td>
                                </tr>
                                
                            </tfoot>
                       </table>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="button" @click="printNow" class="btn btn-primary">Print Now</button>
                   </div>
               </div>
           </div>
       </div>
</template>
<script>
export default {
    props : ['transaction_number', 'transaction_details', 'subtotal', 'grand_total', 'points', 'client_name', 'customerId'],
    data(){
        return {
            usepoints: false,
            points_used: '',
            grand : this.grand_total
        }
    },
    methods : {
        printNow(){
            // alert(this.grand_total)
            this.$emit("printNow", [this.points_used, 'finish']);
            $("#receiptModal").modal('hide')
        },
        removeItem(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove this!'
            }).then((result) => {
            if (result.value) {
                
                axios.get('api/transactionDetails/remove/'+id).then(({data}) => {
                   if(data == 'Successful'){
                        Swal.fire(
                            'Deleted!',
                            'Item has been removed.',
                            'success'
                        )
                        this.$emit('itemRemoved')
                   }else{
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please contact the administrator!.',
                            'error'
                        )
                   }
                });
            }
            })
        },

        computeGrand(){
            this.grand = this.grand_total - this.points_used;

            if(this.points < this.points_used){
                Swal.fire(
                    'Error!',
                    'Points is only '+ this.points ,
                    'warning'
                );

                this.points_used = 0;
                this.grand = this.grand_total
            }

        }
    },

    mounted(){
        $('#tooltip').tooltip()

    }
  
}
</script>