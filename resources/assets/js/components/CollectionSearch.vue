<template>
    <div>
        <div>
            <input type="text" v-model="collection.search"  placeholder="search...."  >
            <button type="submit" class="btn btn-primary" @click.prevent="searchCollection(collection)">Search</button>


        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex'
    export default {

        data(){
            return{
                collection:{
                    search:''
                }
            }
        },
        methods:{
            searchCollection(collection){
                this.$store.dispatch('searchCollection', collection)
            }

        },
        computed: {
            ...mapState([
                'collections',
                'collectionsdata',
                'collectionsview'
            ]),

        },

    }
</script>
