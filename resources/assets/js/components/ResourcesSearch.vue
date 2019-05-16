<template>
    <div>
        <button class="btn btn-primary" @click="backToResource()">Back to Resources</button>
        <button class="btn btn-primary" @click="backToCollection()">Back to Collections</button>
        <h2>search page</h2>
        <div>
            <input type="text"  v-model="objSearch.search" placeholder="search...."  >
            <label>Filter:</label>
            <select id="model_type" v-model="objSearch.modeltype" name="modeltype" >
                <option value="collection" id="collection">Collection</option>
                <option value="resource" id="resource">Resource</option>
            </select >
            <label>Sort:</label>
            <select id="idsort" v-model="objSearch.idsort" name="idsort" >
                <option value="title_sort.asc" >Title Ascending </option>
                <option value="title_sort.desc" >Title Descending</option>
                <option value="id.asc" >Id Ascending </option>
                <option value="id.desc" >Id Descending</option>
            </select >

            <button type="submit" class="btn btn-primary"  @click="elasticSearchData(objSearch)">Search</button>
        </div>
        <div class="container" >
            <div class="col-md-6">
                <h2>Search Result</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="objResource in arrObjElasticSearchResult.arrObjSearchResult">
                        <td>{{objResource.id}}</td>
                        <td>{{objResource.title}}</td>
                        <td>{{objResource.slug}}</td>
                        <td>{{objResource.description}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex'
    export default {

        data(){
            return{
                objSearch:{
                    search:'',
                    modeltype:'',
                    idsort:''
                }
            }
        },
        methods:{
            elasticSearchData(objSearch){
                this.$store.dispatch('elasticSearchData', objSearch)
            },
            backToCollection() {
                window.location.href="http://127.0.0.1:8000/collections"

            },
            backToResource() {
                window.location.href="http://127.0.0.1:8000/resources"

            },

        },
        computed: {
            ...mapState([
                'arrObjSearchResult',
                'arrObjElasticSearchResult'

            ]),
        },

    }
</script>
