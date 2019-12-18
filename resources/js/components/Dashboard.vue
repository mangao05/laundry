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
               <div class="row " >
                   
                   <div class="col-md-7">
                         <label for="">Dashboard</label>
                        <div class="row pt-3" >  
                            <div class="col-md-12 text-center">
                                <div class="info-box p-0  " style="height:130px;" >
                                
                                    <div class="info-box-content">
                                        <span class="info-box-text mt-4 "  style="font-family: 'Anton', sans-serif; font-size:30px;">Total Customer's</span>
                                        <span class="info-box-number h2">{{  all }}</span>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box p-0  " style="height:90px;">
                                    <span class="info-box-icon   p-2"><img src="image/void.png" alt="" srcset=""></span>
                                    <div class="info-box-content m-2">
                                        <span class="info-box-text">For Pick-up</span>
                                        <span class="info-box-number">{{ forPickUp }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="info-box p-0  " style="height:90px;">
                                    <span class="info-box-icon   p-2"><img src="image/iron.png"  alt="" srcset=""></span>
                                    <div class="info-box-content m-2">
                                         <span class="info-box-text">Picked Up</span>
                                        <span class="info-box-number">{{ finish }}</span>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                   </div>
                   <div class="col-md-4">
                       <label for="">Montly Sales</label>
                        <div id="chart" >
                            <apexchart type=donut width='450' :options="chartOptions" :series="series" />
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
                series: [],
                chartOptions: {
                    labels: [],
                    colors: ['#08F7FE','#09FBD3','#FE53BB','#FFACFC','#75D5FD','#A3D8F3','#35212A','#193697','#549F9E','#9CC49D','#D8D99D','#E0A569'],
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
                forPickUp:0,
                finish:0,
                all:0,
                user_Name:'',
                
            }
        },
        methods:{
           status(){
               axios.get('api/dashboardstatus').then(({data}) => {
                    this.forPickUp = data.for_PickUp;
                    this.finish = data.finish;
                    this.all = data.all;
                  
                })
           },
           montlySale(){
                axios.get('api/sales').then(({data}) => {
                    var arrayData = Object.entries(data);
                    arrayData.forEach(element => {
                        this.chartOptions.labels.push(element[0]);
                        this.series.push(element[1].count);  
                    });
                   
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
            this.montlySale();
            if(this.$usertype == 'staff'){
                this.$router.push('/usertransaction');
            }
            console.log('Component mounted.')
        },
      
    }
</script>