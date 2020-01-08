<template>
    <div class="container-fluid input-group mb-3">
        <input type = "text" class="form-control" v-model="searchItem" placeholder="Search" @input="search()"/>
         <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
  </div>
    </div>
</template>
<script>
export default {
    props: ['options'],
    data(){
        return {
           searchItem : ''
        }
    },
    methods : {
        
        search(){
            axios.post('/api/search', {
                table : this.options.table,
                column : this.options.column,
                search : this.searchItem
            }).then(({data}) => {
                this.$emit('searchSuccess', data)
            })
            
        }
    }
}
</script>