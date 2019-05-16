<template>
    <div>
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
                    <tr v-for="objResource in arrObjSearchPageData.arrObjSearchResult">
                        <td>{{objResource.id}}</td>
                        <td>{{objResource.title}}</td>
                        <td>{{objResource.slug}}</td>
                        <td>{{objResource.description}}</td>
                    </tr>
                    <tr v-for="objResource in arrObjSearchPageData.arrObjSearchResult">
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
        methods:{
            searchResourceCollection(objSearch){
                this.$store.dispatch('searchResourceCollection', objSearch)
            },

        },
        computed: {
            ...mapState([
                'arrObjSearchPageData',
            ]),
        },

    }
</script>

<style scoped>

</style>
