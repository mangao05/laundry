<style scoped>
    .box{
        box-shadow:0px 0px 3px gray;

    }
    .letter-spacing{
        letter-spacing: 1px;
    }
    .term ol li{
        max-height:75px !important;
        line-height: 10px;

    }

</style>
<template>
    <div class="container">

        <div class="row letter-spacing">

                <span  @click="openmodal()"  class="badge badge-success p-2 m-2 ml-auto">
                    <i class="fa fa-plus-circle nav-icon" aria-hidden="true"></i> Start Transaction
                </span>



             <div style="width:100%;height:900px;position:relative; " id="printMe"  class="mb-4">
                 <div class="float-left" style="width:20%;height:870px; border:1px solid black;" >
                <div class="text-center p-2">
                    <img src="image/pos.png" alt="" width="50%" srcset="">
                    <br>
                    <div  style="font-size:10px;">
                         <i>BLK 30 lOT 14 Soldiers Hills Village Putatan <br>Muntinlupa City</i>
                    </div>
                     <div  style="font-size:10px;">
                        Contact Us: (02) 501 1603
                    </div>
                    <div style="font-size:10px;">
                        Email Us: 2342443@yahoo.com
                    </div>
                    <div style="font-size:11px;">
                         OPEN AT: <strong> 7:00 AM - 8:00 PM</strong>
                    </div>

                </div>
                <div class="text-center text-bold"  style="border-top:1px solid black;">
                    Client Details
                </div>
                 <div class="p-0" style="border-top:1px solid black;">
                    <ul style="list-style:none; font-size:10px;" class="text-capitalize">
                        <li><strong> Name: </strong> <span>{{ cname }}</span></li>
                        <li><strong>Contant #:</strong> <span>{{ cnumber }}</span></li>
                        <li><strong>Address:</strong> <span >{{ caddress }}</span> </li>
                        <li><strong>Delivery Address: </strong><span>{{ cdaddress }}</span></li>
                        <li><strong>Available Points: </strong><span>{{ points }}</span></li>

                    </ul>
                </div>
                 <div class="text-center  text-bold" style="border-top:1px solid black;">
                   Terms and Condition
                </div>
                <div class="term" style="  border-top:1px solid black;  font-size:10px;">
                        <ol class="mt-3">
                            <li>Article not claimed within 30 days will be charged double the cost service.</li>
                            <li>Article not claimed within 60 days will be disposed of to cover the cost of services rendered.</li>
                            <li>This  Laundry Services shall not be liable for any damages incurred due to the natural effect of washer and dryaer to the garment. To avoid such incidence, client should declare the fragility of items to the washer, dryer ad pressing.</li>
                            <li>This Laundry Services shall not be liable for any change of fire, flood and other unforeseen events or loos through fore majeure.</li>
                            <li>This  Laundry Services shall not be liable for any change resulting from normal washing process loss of buttons, anything lef in the pockets including shrinkage and fading.</li>
                            <li>Liability of loss is limited to an amount not exceeding  <i>three (3) times</i>  the laundry charges.</li>
                            <li>This Laundry Services reserve the right to confirm accuracy of the articles for the laundry and inform the customer of any discrepancy with in <i>24 hours</i></li>
                            <li>Complaints will only be entertained with <i>24 hours for the date of delivery. With <i>30 days</i> will be charged double of the cost service</i></li>
                        </ol>
                </div>
            </div>

             <div class="float-left text-center  text-bold" style="width:30%;height:550px;  border-top:1px solid black;">
                <div   style="border-bottom:1px solid black;">
                    DUE DATE
                </div>
                <div  style=" min-height:76px;" >
                     <span class="text-danger"> {{ new Date() | moment("dddd, MMMM Do YYYY") }}</span>
                     <br>
                     <barcode  :value = "barcode" width = "2" height = "20" background = "transparent" fontSize = "12" lineColor = "#3F4283"></barcode>
                </div>
            </div>

            <div class=" float-left" style="width:25%;height:100px; border-top:1px solid black; border-left:1px solid black">
                   <div class="text-center text-bold">
                        BRANCH CODE
                    </div>
                     <div class="text-center p-3" style=" border-top:1px solid black">
                         {{ branch_code }}
                    </div>
                     <div class="text-center" style="border-top:1px solid black; font-size:10px;">
                         CENTRAL CODE
                    </div>

            </div>
            <div class="float-left" style="width:25%;height:100px; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black">
                 <div class="text-center text-bold" >
                        JOB ORDER NUMBER
                </div>
                <div class="text-center p-3" style=" border-top:1px solid black">
                    {{ transaction_number }}
                </div>
                <div class="text-center" style=" border-top:1px solid black">
                    Point's Earned: <b> {{ grand_total / 100 }}</b>
                </div>
            </div>

            <div class="float-left" style="position:absolute; width:910px;  height:550px; left:230px; top:101px;  ">
                <div style = "height:660px; border-right:1px solid black;">
                     <table  style="width:100%;margin-bottom:1rem;  border-top:1px solid black; table-layout: auto;
  width: 910px;">
                        <thead  style=" border-bottom:1px solid black;" >
                            <tr  class="text-center">

                                <th  class="p-2 pl-3 text-center" style="width: 50%;">Service ( Item )</th>
                                 <th  style="border-left:1px solid black;"  class="p-2 pl-3">Wgt/Qty</th>
                                 <th  style="border-left:1px solid black;" class="p-2 pl-3">Price/Unit</th>
                                <th  class="p-1 " style="border-left:1px solid black; border-right:1px solid black;" >Amount</th>
                            </tr>
                        </thead>
                        <tbody  v-for="details in transaction_details" :key = "details.id" style="font-size:12px;">
                            <tr v-for = "items in details.transaction_items" :key ="items.id" class="align-top text-center">

                                <td scope="row" class="text-capitalize">{{ (items.service.service == "kilo") ? "Per " + items.service.type  : "Per " +items.service.type + " ( "+ items.item +" ) " }}</td>
                                <td>{{ "₱"+ items.service.price }}{{ (items.service.type == 'kilo') ? "/kg" : '/pc' }}</td>
                                <td>{{ (items.service.type == 'kilo') ? items.qty + 'kg': (items.qty > 1 ? items.qty+'pcs' : items.qty+'pc') }}</td>
                                <!-- <td>{{ (items.service.type == 'kilo') ? "₱" + items.qty * items.price  : "₱"+items.price }}</td> -->
                                <td>{{  "₱"+ items.price  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

             <div class="float-left " style="position:absolute; width:80%;  height:180px; left:228px; top:681px; border-right:1px solid black; ">
                  <table style="font-size:13px; width:100%;">
                            <tbody  style="border-top:1px solid black; " >
                                <tr  style="border-top:1px solid black;">
                                    <td style="width: 70%;">Sub-total</td>
                                    <td style=" border-left:1px solid black;"></td>
                                    <td class="text-center" >₱{{ subtotal }}</td>
                                </tr>

                                <tr style="border-top:1px solid black;">
                                    <td>Vat(12%)</td>
                                    <td style=" border-left:1px solid black;"></td>
                                    <td class="text-center">{{ vat }}</td>
                                </tr>
                                <tr style="border-top:1px solid black; font-size:18px">
                                    <td class="text-bold p-2">Grand Total</td>
                                    <td></td>
                                    <td class="text-center text-bold p-2">₱{{ grand_total }}</td>
                                </tr>
                                <!-- <tr style="border-top:1px solid black;">
                                    <td>Points Earned`</td>
                                    <td style=" border-left:1px solid black;"></td>
                                    <td class="text-center">{{ grand_total / 100 }}</td>
                                </tr> -->
                            </tbody>
                        </table>
            </div>

            <div class="float-left " style="width:55%;height:100px;position:absolute;top:770px;left:20%; border-top:1px solid black;border-bottom:1px solid black;   border-right:1px solid black;">
                 <div class="pl-1 text-center pb-2" style="font-size:15px;">
                       By affixing your signature below, client agree with the service terms and condition stipulated herein.
                 </div>
                <div class="pl-1 text-center" style=" text-transform: uppercase;">
                     <b>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;/{{ cashier }}</b>
                </div>

                 <div class="col-4 text-center mx-auto" width="10%" style="border-top :1px solid black;   border-width: inherit; font-size:9px;"  >
                    <p> Signature/Name</p>

                 </div>
            </div>

              <div style="width:20%;height:25px;position:absolute;top:770px;left:70%; border-top:1px solid black; ">
                <div class="text-bold  pl-5 ml-3">
                    Total # of Items:
                </div>
            </div>
            <div style="width:10%;height:25px;position:absolute;top:770px;left:90%; border-top:1px solid black;  border-right:1px solid black;">
                <div class="float-right pr-4" >
                    {{ countItems }}
                </div>
            </div>
            <div style="width:25%;height:75px;position:absolute;top:795px;left:75%;border-bottom:1px solid black;border-right:1px solid black;border-top:1px solid black;  ">
                <div class="pl-4 pt-1">
                  Claimant  Name and Signature:
                </div>
                <br>
                <div class="text-center ">
                     <U class="text-uppercase"> {{ cname }} </U> | {{ new Date() | moment("M-Do-YYYY") }}
                </div>
            </div>
        </div>

            <div class="float-right w-100 mb-4">
                <button @click="reviewTransaction" class="btn btn-success float-right" >Save Transaction</button>
                <button @click="finishTransaction([0,'void'])" class="btn btn-danger float-right mr-2" >Void Transaction</button>
                <button @click="finishTransaction([0,'cancel'])" class="btn btn-secondary float-right mr-2" >Cancel Transaction</button>

            </div>
        </div>
        <laundry :transaction_number = "transaction_number" @transactionSuccess = "fetchTransNumber"></laundry>
        <receipt-modal @printNow = "finishTransaction" :transaction_number = "transaction_number" :transaction_details = "transaction_details" :subtotal = "subtotal" :grand_total = "grand_total" :points = "points" @itemRemoved = "fetchTransNumber" :client_name = "cname" :customerId = "cid"></receipt-modal>
    </div>

</template>


<script>
    export default {
        data(){
            return {
                product : {},
                output: null,
                mode:'Deliver',
                product_type:'',
                transaction_details : {},
                cnumber: 'N/A',
                cname : 'N/A',
                caddress :'N/A',
                cdaddress : 'N/A',
                cid: '',
                subtotal : '0',
                vat: '0',
                grand_total: '0',
                transaction_number : '',
                points : '0',
                tag: 'canvas',
                barcode: '',
                branch_code:'',
                cashier :'',
                countItems : 0
            }
        },
        methods:{
           openmodal(){
               $('#addTransaction').modal('show',{
                    backdrop: 'static',
                    keyboard: false
                });
                Fire.$emit('startTransaction')
           },
            swal(name, msg, type){
                  Swal.fire(
                    name,
                    msg,
                    type
                )
            },
            reviewTransaction(){
                $("#receiptModal").modal('show');
            },
            finishTransaction(type) {
                     axios.get('api/transactions/'+type[1]+"/"+this.transaction_number).then(({data})=>{
                            if(data != "Error"){
                                Fire.$emit('loadData')
                                this.transaction_details = '';
                                this.subtotal = '0';
                                this.vat = '0';
                                this.grand_total = '0';
                                    if(type[1] == 'finish'){
                                        this.$htmlToPaper('printMe');
                                        axios.put('api/points/'+this.cid, {
                                            points : type[0]
                                        }).then((data) => {
                                            this.grand_total = this.grand_total - type[0];

                                        })
                                        this.swal('Finished!', 'Transaction Finished!', 'success');

                                    }else if(type[1] == 'void'){
                                        this.swal('Void!','Transaction Void!','error');
                                    }else{
                                        this.swal('Cancelled!','Transaction Cancelled!','warning')
                                    }
                                }else{
                                    alert("error");
                                }
                            })
                        .catch((err)=>{
                            alert( "Error " + err )
                        })
            },
            fetchTransNumber(){
                let total = [];
                axios.get('api/transactions').then(({data}) => {
                    this.product = data
                    this.transaction_number = 'INSHA_' + data
                    this.barcode = this.transaction_number
                    axios.get('api/transactionDetails/'+this.transaction_number).then(({data}) => {
                        if(data != 'Error'){
                            this.cname = data.customers.name
                            this.cid = data.customers.id
                            this.caddress = data.customers.address1
                            this.cdaddress = data.customers.address2
                            this.cnumber = data.customers.contact_number
                            this.transaction_details = data.transaction_details
                            if(data.customers.customer_points != null){
                                this.points = data.customers.customer_points.points
                            }

                            data.transaction_details.forEach(details => {
                            Object.entries(details.transaction_items).forEach(([key, val]) => {
                                total.push(val.price)
                                this.countItems = details.transaction_items.length
                                });
                            });
                            this.subtotal = total.reduce(function(total, num){ return total + num }, 0);
                            this.vat = this.subtotal * .12;
                            this.grand_total = this.subtotal + this.vat;
                        }
                    });
                });
            },

            fetchBranch(){
                axios.get('api/fetchBranch').then(({data}) => {
                    this.branch_code = data.branch
                    this.cashier = data.name
                })
            }

        },
        created(){
            Fire.$on('loadData', ()=> {
                this.fetchTransNumber();
            });
           
            this.fetchTransNumber();
            this.fetchBranch();
        }
    }
</script>
