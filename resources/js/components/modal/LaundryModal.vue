<template>
    <div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h5 class="modal-title" >Transaction {{ transaction_number }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                         <div class="col-md-6 letter-spacing">
                                    <h1>Customer Detials</h1>
                                    <label for="">Date:</label>
                                        <span class="text-bold">{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span>
                                    <br>
                                    <div class="form-group">
                                        <div>
                                            <label for="">Select Customer</label>
                                            <v-select
                                                v-model = "selectedCustomer"
                                                label="name"
                                                :options="customers"
                                                item-text = "name"
                                                item-value = "_id"
                                                required
                                                @input = "searchCustomer"
                                                placeholder= "Select Customer"
                                                :disabled="transaction_customer"
                                            >
                                            </v-select>
                                        </div>
                                    </div>
                                    <label for="">Customer Name</label>
                                        <input type="text" v-model = "form.cname"  class="form-control" :disabled="transaction_customer">
                                    <label for="">Contact Number</label>
                                        <input type="text" v-model = "form.cnumber" id="" class="form-control" :disabled="transaction_customer">
                                    <label for="">Address </label>
                                        <input type="text" v-model = "form.address1" id="" class="form-control" >
                                    <div class="text-center">
                                            <label for="">Mode of Trasaction</label>
                                        <br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" class="custom-control-input"  v-model="form.mode" value="Deliver" />
                                            <label class="custom-control-label" for="customRadioInline1">Deliver</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" class="custom-control-input" v-model="form.mode" value="Pickup" >
                                        <label class="custom-control-label" for="customRadioInline2">Pickup</label>

                                        </div>
                                    </div>
                                    <div  v-show="form.mode === 'Deliver'">

                                        <label for="">Delivery Address</label>
                                            <input type="text" v-model = "form.address2" id="" class="form-control" >
                                    </div>
                                    <div v-show="form.mode === 'Pickup'">
                                            <label for="">Pick up Date</label>
                                            <input type="text" v-model = "form.cpickDate" id="" class="form-control" >
                                    </div>
                                </div>
                                  <div class="col-md-6" style="border-left: 1px solid black;">
                                  <h1> Transaction Details</h1>
                                  <div class="form-group">
                                        <div>
                                            <label for="">Select Product</label>
                                            <v-select
                                                v-model = "selected"
                                                label="name"
                                                :options="options"
                                                item-text = "name"
                                                item-value = "_id"
                                                required
                                                @input = "searchData"
                                                placeholder= "Select Product"
                                            >
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="item_name">Item <span class="badge badge-info text-white rounded-0 p-2">Leave blank if Per Kilo</span></label>
                                        <input type="text" v-model = "form.item_name" class="form-control rounded-0">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price/Unit</label>
                                        <input type="text" v-model = "form.price" class="form-control rounded-0">
                                    </div>
                                    <div class="form-group">
                                        <label for="qty"><span v-show ="type == 'item'">Quantity</span> <span v-show ="type == 'kilo'">Kilo</span>  <span v-show ="type == 'kilo'" class="badge badge-info rounded-0 p-2 text-white"><span>{{ minimum }}</span> Kilo minimum</span></label>
                                        <input type="text" v-model = "form.qty_kilo" class="form-control rounded-0">
                                    </div>
                                </div>

                    </div>
                </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-show = "transaction_number != 'INSHA_0000'" type="button" class="btn btn-success" @click = "addTransaction">Add Transaction</button>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
    export default {
        props : ['transaction_number'],
        data(){
            return {
                output: null,
                product_type:'',
                options: [],
                selected :'',
                customers: [],
                transaction_customer: false,
                selectedCustomer: '',
                type: '',
                minimum: '',
                form : new Form({
                    service_id : '',
                    price : '',
                    qty_kilo : '',
                    cpickDate :'',
                    cname : '',
                    item_name : '',
                    cnumber : '',
                    mode : 'Deliver',
                    address1: '',
                    address2: '',
                    transaction_number : ''
                })
            }
        },
        methods:{
           fetchData(){
               this.options = [];
               axios.get('api/fetchServices').then(({data})=>{
                   data.forEach(element => {
                       var type = (element.type == 'kilo') ? "/kg" : '';
                       this.options.push({ _id : element.id , name: element.service + " " + "[₱"+element.price + type+"]" })
                   });
               });
           },

           fetchCustomer(){
               this.customers = [];
               axios.get('api/customers').then(({data})=>{
                   data.forEach(element => {
                       this.customers.push({ _id : element.id , name: element.name })
                   });
               });
           },
           addTransaction(){
               this.form.post('api/transactions').then(({data})=>{
                   this.transaction_customer = true
                   this.form.qty_kilo = ""
                   this.form.service_id = ""
                   this.form.item_name =""
                   this.minimum =""
                   this.selected = ""
                   this.form.price = ""
                   this.$emit('transactionSuccess')
                   Toast.fire({
                        type: 'success',
                        title: 'Item Added Successfully'
                    })
               });
           },
           searchData(){
               if(this.selected == null){
                    this.form.item_name = ""
                    this.form.price = ""
                    this.type = ""
                    this.minimum = ""
                    this.form.service_id = ""
               }else{
                    axios.get('api/getService/'+this.selected._id).then(({data})=>{
                        // console.log(data)
                        this.form.item_name = data.service
                        this.form.price = data.price
                        this.type = data.type
                        this.minimum = data.minimum
                        this.form.service_id = this.selected._id
                    });
               }
           },
            searchCustomer(){
               if(this.selectedCustomer == null){
                        this.form.cname = ""
                        this.form.cnumber = ""
                       this.form.address1 = ""
                       this.form.address2 = ""
               }else{
                    axios.get('api/customers/'+this.selectedCustomer._id).then(({data})=>{
                        this.form.cname = data.name
                        this.form.cnumber = data.contact_number
                       this.form.address1 = data.address1
                       this.form.address2 = data.address2
                    });
               }
           }
        },
        created(){
            Fire.$on('startTransaction', () => {
                this.fetchData();
                this.fetchCustomer();
                this.form.transaction_number = this.transaction_number
                axios.get('api/transaction/number/'+this.transaction_number).then(({data})=> {
                    if(data == "Error"){
                        this.transaction_customer = false
                    }else{
                        this.selectedCustomer = data.name
                        this.transaction_customer = true
                        this.form.cname = data.name
                        this.form.cnumber = data.contact_number
                        this.form.address1 = data.address1
                        this.form.address2 = data.address2
                    }
                }).catch((error)=>{
                    console.log(error)
                })
            })


        }
    }
</script>
