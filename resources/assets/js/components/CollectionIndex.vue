<template>
    <div>
        <div v-if="!collectionsview">
            <h4 class="text-center font-weight-bold">Collection</h4>
            <button class="btn btn-info" @click="searchResourceCollection()"><i style="color:white" class="fa fa-trash">search</i></button>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col"> Action</th>
                    <th scope="col"> Favorites/UnFavorites</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="collection in arrObjCollections.data">
                    <td>{{collection.title}}</td>
                    <td>{{collection.description}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditModal" @click="updateCollection(collection)">
                            <span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-danger" @click="deleteCollection(collection)"><span class="glyphicon glyphicon-trash"></span></button>
                        <button class="btn btn-info" @click="viewCollection(collection)"><i style="color:white" class="fa fa-trash">View</i></button>
                    </td>
                    <td>
                        <p v-if="collection.is_favortted">
                            <button class="btn btn-success" @click="addToCollectionFavortted(collection, false)">UnFavorites</button>
                        </p>
                        <p v-else>
                            <button class="btn btn-success" @click="addToCollectionFavortted(collection, true)"> Favorites</button>
                        </p>
                    </td>
                </tr>

                </tbody>
            </table>
         </div>
        <div>
            <collectionsView v-if="collectionsview"  ></collectionsView>
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
                                    <input type="text" id="title" v-model="collection.title" class="form-control input-lg" />
                                </div>
                            </div>
                            <input type="hidden" v-model="collection.id" />
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Description</label>
                                <div class="col-md-8">
                                    <input type="text" id="description" v-model="collection.description" class="form-control input-lg" />
                                </div>
                            </div>
                            <br /><br /><br />
                            <div class="form-group">
                                <button type="submit" :disabled="!isValid" data-dismiss="modal" class="btn btn-block btn-primary" @click="updateCollectionDetails">Submit</button>
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
    import collectionsView from './CollectionView'
    export default {

        data(){
            return {
                collection: {
                    id:'',
                    title: '',
                    description: ''
                },
                boolCollectionView:false
            }
        },

        mounted() {

            this.$store.dispatch('fetchCollectionsResources')

        },
        methods: {
            deleteCollection(collection) {
                this.$store.dispatch('deleteCollection',collection)
            },
            viewCollection(objCollection) {
                this.boolCollectionView = true;
                this.$store.commit('VIEW_COLLECTION', {objCollection: objCollection})
            },
            updateCollection(collection) {
                this.collection.id           = collection.id;
                this.collection.title        = collection.title;
                this.collection.description  = collection.description;
            },
            updateCollectionDetails() {

                this.$store.dispatch('updateCollection',{id:this.collection.id,title:this.collection.title,description:this.collection.description})
            },
            addToCollectionFavortted(collection) {

                this.$store.dispatch('addToCollectionFavortted',collection)
            },
            searchResourceCollection() {
                window.location.href="http://127.0.0.1:8000/collections/search/search"

            }
        },
        computed: {
            ...mapState([
               'collections',
                'collectionsview',
                'arrObjResources',
                'arrObjCollections'

            ]),
            isValid() {
                return this.collection.title !== '' && this.collection.description !== ''

            }
        },
        components: {
            collectionsView:collectionsView
        },

    }
</script>
