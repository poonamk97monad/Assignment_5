<template>
    <div>
        <button class="btn btn-info" @click="viewCollection(collection)">Back</button>
        <div class="container" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Example Component</div>
                        <center>
                            <h4>ID          :{{collectionsview.id}}</h4>
                            <h4>TITLE       :{{collectionsview.title}}</h4>
                            <h5>SLUG        :{{collectionsview.slug}}</h5>
                            <h5>DESCRIPTION :{{collectionsview.description}}</h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#collection">Add collection</button>
        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col"> Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="objCollection in collectionsview.resources">
                    <td>{{objCollection.id}}</td>
                    <td>{{objCollection.slug}}</td>
                    <td>{{objCollection.description}}</td>
                    <td>
                        <button class="btn btn-danger" @click="removeResourceToCollection(objCollection,collectionsview.id)">Remove to Resource</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="collection" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="favoritesModalLabel">All Resource list</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Description</th>
                                <th scope="col"> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="ObjResource in arrObjResources">
                                <td>{{ObjResource.title}}</td>
                                <td>{{ObjResource.slug}}</td>
                                <td>{{ObjResource.description}}</td>
                                <td>
                                    <button data-dismiss="modal" class="btn btn-success" @click="addResourceToCollection(ObjResource,collectionsview.id)">Add Resource</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex'
    export default {
        mounted() {
            this.$store.dispatch('fetchCollectionsResources')
        },
        methods: {
            viewCollection() {
                this.$store.commit('VIEW_COLLECTION', {objCollection: false})
            },
            addResourceToCollection(collection,intCollectionId) {
                this.$store.dispatch('addResourceToCollection',{'collection': collection, 'intCollectionId': intCollectionId})
            },
            removeResourceToCollection(collection,intCollectionId) {
                this.$store.dispatch('removeResourceToCollection',{'collection': collection, 'intCollectionId': intCollectionId})
            }
        },
        computed: {
            ...mapState([
                'collections',
                'collectionsview',
                'arrObjResources',
                'arrObjCollections'
            ])
        }
    }
</script>
