<template>
    <div>
        <button class="btn btn-info" @click="viewResource(resource)">Back</button>
        <div class="container" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Example Component</div>
                        <center>
                        <h4>ID          : {{resourcesview.id}}</h4>
                        <h4>TITLE       : {{resourcesview.title}}</h4>
                        <h5>SLUG        : {{resourcesview.slug}}</h5>
                        <h5>DESCRIPTION : {{resourcesview.description}}</h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#collection">Add Resources</button>
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
                <tr v-for="objCollection in resourcesview.collections">
                    <td>{{objCollection.id}}</td>
                    <td>{{objCollection.slug}}</td>
                    <td>{{objCollection.description}}</td>
                    <td>
                        <button class="btn btn-danger" @click="removeCollectionToResource(objCollection,resourcesview.id)">Remove to Resource</button>
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
                        <h4 class="modal-title" id="favoritesModalLabel">All Collection list</h4>
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
                            <tr v-for="objCollection in arrObjCollections">
                                <td>{{objCollection.title}}</td>
                                <td>{{objCollection.slug}}</td>
                                <td>{{objCollection.description}}</td>
                                <td>
                                    <button class="btn btn-success" data-dismiss="modal" @click="addCollectionToResource(objCollection,resourcesview.id)">Add to Resource</button>
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
            this.$store.dispatch('fetchResourcesCollections')

        },
        methods: {
            viewResource() {
                this.$store.commit('VIEW_RESOURCE',{objResource: false})
            },
            addCollectionToResource(resource,intResourceId) {
                this.$store.dispatch('addCollectionToResource',{'resource': resource, 'intResourceId': intResourceId})
            },
            removeCollectionToResource(resource,intResourceId) {
                this.$store.dispatch('removeCollectionToResource',{'resource': resource, 'intResourceId': intResourceId})
            }
        },
        computed: {
            ...mapState([
                'resourcesview',
                'intResourceId',
                'arrObjResources',
                'arrObjCollections'
            ])

        }
    }
</script>
