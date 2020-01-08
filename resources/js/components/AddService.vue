<template>
    <div class="container">

             <h6>Services</h6>
             
             <div class="row" >
                 <div class="col-md-9 ">
                     <div class="input-group input-group-sm float-left mb-4" style="width: 150px;">
                            <button class="btn btn-success rounded-0 " @click= "openServiceModal"> <i class="fa fa-plus" aria-hidden="true"></i> Add Services</button>
                    </div>
                 </div>
                 <div class="col-md-3">
                       <search :options="searchOptions" @searchSuccess="search"></search>
                     
                 </div>
                   
             </div>
         
           
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Minimum</th>
                            <th>Action</th>
                        </tr>

                        <tr v-show="services.length == 0">
                            <td colspan="7" class="text-center jumbotron" style="font-size:30px;"> <i> No items Found</i></td>
                        </tr>

                        <tr v-for="(service, index) in services" :key = "service.id">
                            <td>{{ index+1 }}</td>
                            <td>{{ service.service }}</td>
                            <td>{{ service.price }}</td>
                            <td>{{ service.type }}</td>
                            <td>{{ service.minimum }}</td>
                             <td>
                                <span class="badge badge-primary p-2" @click = "editService(service.id)" >Edit</span>
                                <span class="badge badge-danger p-2" @click = "deleteService(service.id)">Delete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <service-modal :modalName = "modalName" @createdSuccess = "successCreated"></service-modal>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                modalName : "Add Services",
                services : {},
                editServices : {},
                form : new Form({}),
                searchOptions : {
                    table : 'services',
                    column : 'service'
                },
            }
        },
        methods:{
            search(e){
                this.services = e
            },
            openServiceModal(){
                Fire.$emit('createMode');
                $("#modelId").modal('show');
            },
            successCreated(){
                // $("#modelId").modal('hide');
                this.loadServices();
            },
            loadServices(){
                axios.get('api/services').then(({data}) => {
                    this.services = data
                })
            },
            editService(id){
                axios.get('api/services/'+id).then((data) => {
                    this.editServices = data.data
                    console.log( this.editServices);
                    Fire.$emit('editmode', this.editServices);
                       $("#modelId").modal('show');
                });
            },
            deleteService(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    this.form.delete('api/services/'+id).then(()=>{
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                         this.loadServices();
                    }).catch(()=>{

                    });

                }
                })
            }

    },
        created: function(){
            this.loadServices();
        },
    }
</script>
