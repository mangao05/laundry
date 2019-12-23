<template>
    <div class="container-fluid">
        <input type = "text" class="form-control" v-model="searchItem" placeholder="Search" @input="search()"/>
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