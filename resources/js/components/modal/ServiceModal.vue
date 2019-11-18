<style scoped>
    .list-item {
        display: inline-block;
        margin-right: 10px;
    }
    .list-enter-active, .list-leave-active {
        transition: all 3s;
    }
    .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: translateY(30px);
    }
</style>
<template>
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" :class = "(editMode === false) ? '' : ''" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalName }}
                            <!-- {{ (Object.keys(services).length === 0) ? "No services" : services }} -->
                        </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6" >
                                <div class="text-center">
                                    <span class="font-weight-bold">Last Created</span><br>
                                </div>

                                <!-- <div class="row justify-content-end " >
                                    <div class="col-3 p-0 mb-2" v-show=" servicesCreatedToday !=''">
                                        <span class="badge badge-success p-2 letter-spacing rounded-0" style="border: 1px solid green;">View All</span>
                                    </div>
                                </div> -->
                                 <div class="col-12 p-0 mb-2 bg-dark mt-5" v-show="servicesCreatedToday ==''">
                                      <center>  <span class="letter-spacing " style="font-size:30px;">No Data to display</span> </center>
                                    </div>
                                <transition-group appear name="list" tag="div">
                                   <!-- <div class="p-2"> -->
                                        <div v-for="created in servicesCreatedToday" :key = "created.id" style="box-shadow: 0px 0px 3px gray; width: 100%;" class="mb-2 p-3 list-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="badge badge-info text-white p-2 letter-spacing" >Per {{ created.type }}</span><br>
                                                    <span class="font-weight-bold">Services:  </span><span>{{ created.service }}</span><br>
                                                    <span class="font-weight-bold">Price: </span><span>{{ (created.type == 'kilo') ? '&#8369;'+created.price+ '/kg' : '&#8369;'+created.price }}</span> <br>
                                                    <span class="font-weight-bold">Minimum: </span><span>{{ (created.type == 'kilo') ? created.minimum + 'kg' : 'No Minimum' }}</span> <br>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <span><img :src="'/serviceIcon/'+created.icon" class="img-fluid w-50"></span>
                                                </div>
                                            </div>
                                           

                                            <!-- <span class="font-weight-bold">Price: </span><span>{{ price }}</span> -->
                                        </div>
                                    <!-- </div>  -->
                                </transition-group>

                            </div>
                            <div class="col-6">
                                <span class="text-danger "><i>*icon can be 251x 251</i></span>
                                <div id="preview " class="m-2 text-center ">
                                    <img v-if="imageUrl" :src="imageUrl" class="img-fluid w-25 border border-dark" />
                                </div>
                                <input type="file" accept="image/*" @change="onChange" />
                                
                                <div class="form-group">
                                <label>Services</label>
                                <input v-model="form.service" type="text" name="username"
                                    class="form-control rounded-0"  :class="{ 'is-invalid': form.errors.has('service') }">
                                <has-error :form="form" field="service"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input v-model="form.price" type="text" name="username"
                                        class="form-control rounded-0"  :class="{ 'is-invalid': form.errors.has('price') }">
                                    <has-error :form="form" field="price"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <select v-model="form.type" class="form-control rounded-0" :class="{ 'is-invalid': form.errors.has('type') }">
                                        <option value="">Select Type</option>
                                        <option value="kilo">Per Kilo</option>
                                        <option value="item">Per Item</option>
                                    </select>
                                    <has-error :form="form" field="type"></has-error>
                                </div>

                                <div class="form-group rounded-0" v-show="form.type == 'kilo'" style="display:none;">
                                    <label>Minimum</label>
                                    <input v-model="form.minimum" type="text" name="username"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('minimum') }">
                                    <has-error :form="form" field="minimum"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="editMode === true ? update() : save()" class="btn btn-primary">{{ editMode === true ? "Update" : "Save" }}</button>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    export default {
        props: ['modalName'],
         name: 'imageUpload',
        data(){
            return {
                image : null,
                imageUrl: null,
                editMode: false,
                servicesCreated : {},
                servicesCreatedToday: {},
                form: new Form({
                    service_id : '',
                   service: '',
                   type : '',
                   minimum : '',
                   price:'',
                   deleted_at:''
                })
            }
        },
        methods:{
            save(){
                this.form.post('api/services').then(({data}) => {
                    this.servicesCreated = data;
                    this.loadDailyCreatedServices();
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Saved Successfully'
                    })
                    this.$emit('createdSuccess')
                }).catch(()=>{
                });
            },
            update(){
                this.form.put('api/services/'+this.form.service_id).then((data) => ( this.$emit('createdSuccess') ))
            },

            loadDailyCreatedServices(){
                axios.get('api/dailyServices').then((data)=>(this.servicesCreatedToday = data.data))
            },
             onChange(e) {
                const file = e.target.files[0]
                this.image = file
                this.imageUrl = URL.createObjectURL(file)
            }
        },

        created: function() {
            this.loadDailyCreatedServices();
            Fire.$emit('dailyServices', () => {
                this.loadDailyCreatedServices();
            });
            Fire.$on('editmode', (data) => {
                this.editMode = true;
                this.form.fill(data)
                this.form.service_id = data.id
            });

            Fire.$on('createMode', () => {
                this.editMode = false;
                this.form.reset();
                this.form.clear();
            })

        }
    }
</script>

