<style scoped>
    
</style>
<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
               <div class="card"  style="background: url('image/banner.jpg'); background-size:100% 100%; height:120px; background-position: center; ">
                   <div class="card-body row">
                   
                       <div class="col-6 p-4 text-center">
                            <h2 class="pt-1" >
                                <p >Welcome Back, Administrator</p>
                            </h2>
                       </div>
                      
                   </div>

                   <div class="row">
                       <div class="col-3">
                            <div class="info-box  bg-success">
                                <span class="info-box-icon "><img src="image/1.png" height="70" alt="" srcset=""></span>
                                <div class="info-box-content m-2">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                       </div>
                       <div class="col-3">
                           <div class="info-box  bg-warning">
                                <span class="info-box-icon "><img src="image/loginIcon.jpg" height="70" alt="" srcset=""></span>
                                <div class="info-box-content m-2">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                       </div>
                       <div class="col-3">
                            <div class="info-box  bg-secondary">
                                <span class="info-box-icon "><img src="image/ironing.png" alt="" srcset=""></span>
                                <div class="info-box-content m-2">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                       </div>
                       <div class="col-3">
                           <div class="info-box  bg-danger">
                                <span class="info-box-icon "><img src="image/washing-machine.png" alt="" srcset=""></span>
                                <div class="info-box-content m-2">
                                    <span class="info-box-text">Likes</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>