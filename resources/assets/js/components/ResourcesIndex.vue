<template>
    <div>
        <div v-if="!resourcesview">
            <h4 class="text-center font-weight-bold">Resources</h4>
            <button class="btn btn-info" @click="searchResourceCollection()"><i style="color:white" class="fa fa-trash">Vue  search</i></button>
             <br><br>
            <button class="btn btn-info" @click="elasticSearch()"><i style="color:white" class="fa fa-trash">Elastic Search</i></button>
            <br><br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col"> Action</th>
                    <th scope="col"> Favorites/UnFavorites</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="objResource in arrObjResources.data">
                    <td>{{objResource.id}}</td>
                    <td>{{objResource.title}}</td>
                    <td>{{objResource.slug}}</td>
                    <td>{{objResource.description}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditModal" @click="updateResource(objResource)">
                            <span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-danger" @click="deleteResource(objResource)"><span class="glyphicon glyphicon-trash"></span></button>
                        <button class="btn btn-info" @click="viewResource(objResource)"><i style="color:white" class="fa fa-trash">View</i></button>
                    </td>
                    <td>
                        <p v-if="objResource.is_favortted">
                            <button class="btn btn-success" @click="addToResourceFavortted(objResource, false)">UnFavorites</button>
                        </p>
                        <p v-else>
                           <button class="btn btn-success" @click="addToResourceFavortted(objResource, true)"> Favorites</button>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <resourcesView v-if="resourcesview"></resourcesView>
        </div>

        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="favoritesModalLabel">Edit From</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Title of File</label>
                                <div class="col-md-8">
                                    <input type="text" id="title" v-model="resource.title" class="form-control input-lg" />
                                </div>
                            </div>
                            <input type="hidden" v-model="resource.id" />
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Description</label>
                                <div class="col-md-8">
                                    <input type="text" id="description" v-model="resource.description" class="form-control input-lg" />
                                </div>
                            </div>
                            <br /><br /><br />
                            <div class="form-group">
                                <button type="submit" :disabled="!isValid" data-dismiss="modal" class="btn btn-block btn-primary" @click="updateResourceDetails">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>'
<script>
    import {mapState} from 'vuex'
    import resourcesView from './ResourceView'
    export default {
        data(){
            return {
                resource: {
                    id:'',
                    title: '',
                    description: ''
                },
                boolResourceView:false,
            }
        },
        mounted() {
            this.$store.dispatch('fetchResourcesCollections')
        },
        methods: {
            deleteResource(objResource) {
                this.$store.dispatch('deleteResource',objResource)
            },
            viewResource(objResource) {
                this.boolResourceView = true;
                this.$store.commit('VIEW_RESOURCE', {objResource: objResource})
            },
            searchResourceCollection() {
                window.location.href="http://127.0.0.1:8000/resources/search/search"

            },
            updateResource(objResource) {
                this.resource.id          = objResource.id;
                this.resource.title       = objResource.title;
                this.resource.description = objResource.description;
            },
            updateResourceDetails() {
                this.$store.dispatch('updateResource',{id:this.resource.id,title:this.resource.title,description:this.resource.description})
            },
            addToResourceFavortted(objResource) {
                this.$store.dispatch('addToResourceFavortted',objResource)
            },
            elasticSearch(){
                window.location.href="http://127.0.0.1:8000/searchPage"
            }
        },
        computed: {
            ...mapState([
                'resourcesview',
                'arrObjResources',
                'isFavorites'
            ]),
            isValid() {
                return this.resource.title !== '' && this.resource.description !== ''
            }
        },
        components: {
            resourcesView:resourcesView,
        },
    }
</script>

