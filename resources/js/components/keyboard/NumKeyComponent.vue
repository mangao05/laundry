<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4" v-for="(num, index) in getNumbers(1,4)" :key="index">
               <button class="btn btn-secondary btn-block font-weight-bold text-center py-3">{{ num }}</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
         getNumbers:function(start,stop){
            return new Array(stop-start).fill(start).map(( n , i ) => n+i);
        },
    }
}
</script>