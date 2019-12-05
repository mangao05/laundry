<template>
    <div>
        <div class="col-lg-4" v-for="(n, index) in getNumbers(start, stop)" :key="index">
            <button class="btn btn-secondary btn-block"   @click="type(n)">
                {{ n }}
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props : ['start', 'stop'],
    methods: {
         getNumbers:function(start,stop){
            return new Array(stop-start).fill(start).map(( n , i ) => n+i);
        },
        type(number){
            let sum = "";
            if(this.value == ""){ 
                sum = number;
            }else{
                sum = this.value+number;
            }

            this.value = sum.toString();
        },
    },
}
</script>