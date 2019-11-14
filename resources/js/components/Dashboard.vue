<style scoped>
   @import url('https://fonts.googleapis.com/css?family=Righteous&display=swap');
   @import url('https://fonts.googleapis.com/css?family=Anton&display=swap');
   </style>
<template>
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col-12">
               <div class="card"  style="background: url('image/banner.jpg'); background-size:100% 100%; height:120px; background-position: center; ">
                   <div class="card-body row">
                   
                       <div class="col-6 p-4 text-center">
                            <h2 class="pt-1" >
                                <p style="font-family: 'Righteous', cursive;" >Welcome Back,<span style="font-family: 'Anton', sans-serif;"> {{ user_Name }}</span></p> 
                            </h2>
                       </div>
                      
                   </div>
               </div>
               <div class="row">
                   
                   <div class="col-md-7">
                         <label for="">Dashboard</label>
                        <div class="row">  
                            <div class="col-md-6">
                                <div class="info-box p-0  " style="height:90px;" >
                                    <span class="info-box-icon  p-2"><img src="image/pending.png"  alt="" srcset=""></span>
                                    <div class="info-box-content m-2">
                                        <span class="info-box-text">Pending</span>
                                        <span class="info-box-number">{{ pending }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                     <div class="info-box p-0 " style="height:90px;" >
                                        <span class="info-box-icon   p-2"><img src="image/iron.png"  alt="" srcset=""></span>
                                        <div class="info-box-content m-2">
                                            <span class="info-box-text">Finish</span>
                                            <span class="info-box-number">{{ finish }}</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box p-0  " style="height:90px;">
                                    <span class="info-box-icon   p-2"><img src="image/cancelled.png" alt="" srcset=""></span>
                                    <div class="info-box-content m-2">
                                        <span class="info-box-text">Cancelled</span>
                                        <span class="info-box-number">{{ cancelled }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box p-0  " style="height:90px;">
                                    <span class="info-box-icon   p-2"><img src="image/void.png" alt="" srcset=""></span>
                                    <div class="info-box-content m-2">
                                        <span class="info-box-text">Void</span>
                                        <span class="info-box-number">{{ Statusvoid }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-4 ">
                       <label for="">Daily Sales</label>
                        <div id="chart">
                            <apexchart type=donut width=380 :options="chartOptions" :series="series" />
                        </div>
                   </div>
               </div>
                 
               </div>  
            </div>
           
      
         
        </div>  
</template>

<script>
    export default {
        data(){
        Vue.prototype.$usertype = document.querySelector("meta[name='user_type']").getAttribute('content')

            return {
             series: [1,2,3,4,5,6,7],
                chartOptions: {
                labels: ['Monday','Tuesday','Wenesday','Thursday','Friday','Satruday','Sunday'],
                colors: ['#08F7FE','#09FBD3','#FE53BB','#FFACFC','#75D5FD','#A3D8F3','#35212A',],
                responsive: [{
                    breakpoint: 10,
                    options: {
                   
                    chart: {
                        width: 10
                    },
                    legend: {
                        position: 'bottom'
                    }
                    }
                }]
                },

                pending:0,
                finish:0,
                cancelled:0,
                Statusvoid:0,

                user_Name:'',
            }
        },
        methods:{
           status(){
               axios.get('api/dashboardstatus').then(({data}) => {
                    this.pending = data.on_going;
                    this.finish = data.finish;
                    this.cancelled = data.cancelled;
                    this.Statusvoid = data.void;
                })
           },
           userName(){
                axios.get('api/loginDetail').then(({data}) => {
                   this.user_Name = data.name;
                 
                })
           }
        },
        mounted() {
            this.status();
            this.userName();
            if(this.$usertype == 'staff'){
                this.$router.push('/usertransaction');
            }
            console.log('Component mounted.')
        },
      
    }
</script>