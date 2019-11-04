<style scoped>
#style-7::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
	border-radius: 10px;
}

#style-7::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
    border-radius: 10px;
}

#style-7::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	background-image: -webkit-gradient(linear,
									   left bottom,
									   left top,
									   color-stop(0.44, rgb(122,153,217)),
									   color-stop(0.72, rgb(73,125,189)),
									   color-stop(0.86, rgb(28,58,148)));
}
</style>
<template>
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
            <div class="modal-content ">
                <div class="modal-header bg-dark border-0">
                    <h5 class="modal-title font-weight-bold">{{ transaction_number }}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body bg-dark">
                    <div class="text-center">
                        <h1 style="text-shadow: 2px 0px 1px #000000;;  transform: scale(1, 1); font-family: Arial" class="font-weight-bold text-white text-uppercase">{{ transaction_customer.name }}
                        </h1>
                        Contact# : <span class="text-warning">{{ transaction_customer.contact_number }}</span>
                        <div class="row">
                            <div class="col-6 p-1">
                                Address 1: <span class="text-warning">{{ transaction_customer.address1 }}</span>
                            </div>
                            <div class="col-6 p-1">
                                 Delivery Address: <span class="text-warning">{{ transaction_customer.address2 }}</span>
                            </div>
                        </div>
                        <h3>Remaining Points: <span class="text-danger">{{ customer_points.points }}</span></h3>
                    </div>
                    <br>
                    <!-- Start Transaction Details -->
                   

                   
                        <h4>Transaction Details</h4>
                         <div style="overflow-y: scroll; max-height:600px;" class="scrollbar" id="style-7" >
                        <table class="table table-striped table-bordered text-white mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th style="min-width: 200px; " class="text-center">Service(ITEM)</th>
                                    <th>Price/Unit</th>
                                    <th>Qty/Wgt</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody v-for = "details in transaction_details" :key = "details.id" style="font-size:12px;">
                                <tr v-for = "items in details.transaction_items" :key ="items.id" class="align-top text-center">
                                        <td scope="row" >{{ (items.service.service == "kilo") ? "Per " + items.service.service  : "Per " +items.service.service + " ( "+ items.item +" ) " }}</td>
                                        <td>{{ "₱"+ items.service.price }}{{ (items.service.type == 'kilo') ? "/kg" : '/pc' }}</td>
                                        <td>{{ (items.service.type == 'kilo') ? items.qty + 'kg': (items.qty > 1 ? items.qty+'pcs' : items.qty+'pc') }}</td>
                                        <td>{{  "₱"+ items.price  }}</td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Subtotal :</td>
                                    <td class="text-center">₱{{ subtotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Vat :</td>
                                    <td class="text-center">₱{{ vat }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Grand Total :</td>
                                    <td class="text-center">₱{{ grand_total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Points Used :</td>
                                    <td class="text-center">123</td>
                                </tr>
                            </tfoot>
                        </table>
                     </div>
                   
                    <!-- End Transaction Details -->
                </div>
                <!-- <div class="modal-footer border-0 bg-dark text-white">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['transaction_details', 'subtotal', 'transaction_number', 'transaction_customer', 'customer_points'],
    data(){
        return {
            
        }
    },
    methods : {
       
    },
    created(){
       
    },
   computed : {
       vat : function(){
           return this.subtotal * .12
       },
       grand_total : function(){
           return this.subtotal + this.vat
       }
   }
}
</script>