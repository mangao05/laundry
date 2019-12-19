<template>
    <div class="container">
        <!-- <input type="text" class="form-control " v-model="value" placeholder="amount" /> -->
        <h1 v-show="amount">Amount to be paid: <span class="badge badge-info">{{ parseInt(amount) | currency  }}</span> </h1>
        <span v-if="value == ''" class="form-control mb-2 text-center font-weight-bold text-uppercase" style="height: 70px; font-size: 28px;">{{ options.label }}</span>
         <span v-else class="form-control mb-2 text-center font-weight-bold text-uppercase" style="height: 70px; font-size: 28px;"> 
             <span v-if="options.number_only">{{ value }}</span>
            <span v-else>{{ value | currency }}</span>

         </span>
        <!-- Output  1-3 numbers -->
        <div class="row mb-2">
            <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'" v-for="(n, index) in getNumbers(1,4)" :key="index">
                <button class="btn btn-secondary btn-block py-3 font-weight-bold"   @click="type(n)">
                    {{ n }}
                </button>
            </div>
             <div class="col-lg-3" v-show="!options.number_only">
                <button class="btn btn-primary btn-block py-3 font-weight-bold" @click="wholeAmount(20)">20</button>
            </div>   
        </div>
        <!-- Output 4-6 numbers  -->
        <div class="row mb-2">
            <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'" v-for="(n, index) in getNumbers(4,7)" :key="index">
                <button class="btn btn-secondary btn-block py-3 font-weight-bold"   @click="type(n)">
                    {{ n }}
                </button>
            </div>
             <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'" v-show="!options.number_only">
                <button class="btn btn-primary btn-block py-3 font-weight-bold" @click="wholeAmount(50)">50</button>
            </div>   
        </div>
        <!-- Output 7 - 9 numbers-->
        <div class="row mb-2">
          <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'" v-for="(n, index) in getNumbers(7,10)" :key="index">
                <button class="btn btn-secondary btn-block py-3 font-weight-bold"   @click="type(n)">
                    {{ n }}
                </button>
            </div>
             <div class="col-lg-3" v-show="!options.number_only">
                <button class="btn btn-primary btn-block py-3 font-weight-bold" @click="wholeAmount(100)">100</button>
            </div>   
        </div>
        
        <div class="row mb-2">
            <div class="col-lg-3" :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button class="btn btn-secondary btn-block py-3 font-weight-bold" @click="type('00')">
                    00
                </button>
            </div>

            <div class="col-lg-3" :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button class="btn btn-secondary btn-block py-3 font-weight-bold" @click="type('0')">
                    0
                </button>
            </div>
             <div class="col-lg-3" :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button  class="btn btn-secondary btn-block py-3 font-weight-bold" @click="type('.')">
                    .
                </button>
            </div>
             <div class="col-lg-3" v-show="!options.number_only">
                <button class="btn btn-primary btn-block py-3 font-weight-bold" @click="wholeAmount(500)">500</button>
            </div>   
        </div>
        <div class="row mb-2">
            <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button class="btn bg-white btn-block py-3 font-weight-bold" @click="removeLast()" title="CLEAR">
                    <i class="fa fa-backward" aria-hidden="true"></i> <br> <span style="font-size: 10px;">Clear</span>
                </button>
            </div>
            <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button class="btn btn-warning btn-block py-3 font-weight-bold" @click="clear()" title="CLEAR ALL">
                    <i class="fa fa-times" aria-hidden="true"></i> <br> <span style="font-size: 10px;">Clear All</span>
                </button>
            </div>
            <div :class="options.number_only ? 'col-lg-4' : 'col-lg-3'">
                <button class="btn btn-danger btn-block py-3 font-weight-bold" @click="closeModal()" title="Back">
                    <i class="fa fa-arrow-up" aria-hidden="true"></i> <br> <span style="font-size: 10px;">Back</span>
                </button>
            </div>
             <div class="col-lg-3" v-show="!options.number_only">
                <button class="btn btn-primary btn-block py-3 font-weight-bold" style="height: 80px;" @click="wholeAmount(1000)">1000</button>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12">
                <button class="btn btn-success btn-block font-weight-bold" @click="returnValue()" title="Enter">
                    ENTER <br> <span style="font-size: 10px;">Return</span>
                </button>
            </div>
        </div>
       
    </div>
</template>
<script>
export default {
    props: ['options', 'amount'],
    data(){
        return {
            value : ""
        }
    },
    methods : {
        type(number){
            let sum = "";
            if(this.value == ""){ 
                number == '.' ? sum = '0'+ number : sum = number;
            }else if(this.value == '00'){
                number == '.' ? sum = '0'+ number : sum = number;
            }else if(this.value == '0'){
                number == '.' ? sum = this.value + number : sum = number;
            }else{
                sum = this.value+number;
            }

            this.value = sum.toString();
        },
        getNumbers:function(start,stop){
            return new Array(stop-start).fill(start).map(( n , i ) => n+i);
        },
        removeLast(){
            let amount = this.value.toString();
            this.value = amount.slice(0, this.value.length - 1);       
        },
        clear(){
            this.value = "";
        },
        returnValue(){
           this.$parent.returnAmount(this.value)
           this.value ='';
        },
        wholeAmount(amount){
            let currentAmount = parseInt(this.value);   
            if(this.value != ''){
                this.value = currentAmount + amount;  
            }else{
                this.value = amount.toString();
            }
        },
        closeModal(){
            
            this.$emit('closeModal');
        }
    }
}
</script>