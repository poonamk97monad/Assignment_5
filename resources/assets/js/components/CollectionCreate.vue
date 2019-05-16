<template>
 <div>
     <div v-if="!collectionsview">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#collectionsModal">Add New Collections</button>
    <hr>
    <div class="modal fade" id="collectionsModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="favoritesModalLabel">Add Collection </h4>
                </div>
                <div class="modal-body">
                    <div>
                        <form @submit="createCollection(collection)">
                            <span id="form_output"></span>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Title of File</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" v-model="collection.title" id="title" class="form-control input-lg" />
                                </div>
                            </div>
                            <br/><br/><br/>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Description</label>
                                <div class="col-md-8">
                                    <input type="text" name="description" v-model="collection.description" id="description" class="form-control input-lg" />
                                </div>
                            </div>
                            <br /><br /><br />
                            <div class="form-group">
                                <button :disabled="!isValid" data-dismiss="modal" class="btn btn-block btn-primary" @click.prevent="createCollection(collection)">Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     </div>
 </div>
</template>

<script>
    import {mapState} from 'vuex'
    import collectionsView from './CollectionView'
    export default {

        name: "CreateCollection",
        data() {
            return {
                collection: {
                    title: '',
                    description: ''
                }
            }
        },
        methods: {
            createCollection(collection) {
                this.$store.dispatch('createCollection', collection)
            }
        },
        computed: {
            ...mapState([
                'collections',
                'collectionsdata',
                'collectionsview'
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
