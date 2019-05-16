let mutations = {
    CREATE_RESOURCE(state, resource) {
        state.resources.unshift(resource)
    },
    FETCH_RESOURCES_COLLECTIONS(state, payload) {
        state.arrObjResources    = payload.arrObjResources
        state.arrObjCollections  = payload.arrObjCollections
    },
    FETCH_COLLECTIONS_RESOURCES(state, payload) {
        state.arrObjCollections  = payload.arrObjCollections
        state.arrObjResources    = payload.arrObjResources

    },
    FAVORITES_RESOURCE(state, response) {
        let intId = response.id;
        state.arrObjResources.data.forEach(function(item ,i) {
            if(item.id == intId) {
                state.arrObjResources.data[i].is_favortted = !item.is_favortted;
            }
        });
    },
    FAVORITES_COLLECTION(state, response) {
        let intId = response.id;
        state.arrObjCollections.data.forEach(function(item ,i) {
            if(item.id == intId) {
                state.arrObjCollections.data[i].is_favortted = !item.is_favortted;
            }
        });
    },
    DELETE_RESOURCE(state, resource) {
        let index = state.resources.findIndex(item => item.id === resource.id)
        state.resources.splice(index, 1)
    },

    ADD_REMOVE_COLLECTION_TO_RESOURCE(state, payload) {
        state.resourcesview = payload.objResource
    },
    ADD_REMOVE_RESOURCE_TO_COLLECTION(state, payload) {
        state.collectionsview = payload.objCollection
    },
    VIEW_RESOURCE(state, payload) {
        state.resourcesview = payload.objResource
    },
    UPDATE_RESOURCE(state, resource) {
        let index = state.resources.findIndex(item => item.id === resource.id)
        state.resources.splice(index, 1)
    },
    CREATE_COLLECTION(state, collection) {
        state.collections.unshift(collection)
    },
    VIEW_COLLECTION(state, payload) {
        // let index = state.resources.findIndex(item => item.id === resource.id)
        state.collectionsview = payload.objCollection
    },
    SEARCH_RESOURCE_COLLECTION(state, payload) {
        console.log("PAYLOAD")
        console.log(payload)
        state.arrObjSearchPageData    = payload
        // state.arrObjSearchCollections  = payload.arrObjCollectionSearch
    },
    SEARCH_COLLECTION(state, payload) {
        console.log('payload')
        console.log(payload)
        // let index = state.resources.findIndex(item => item.id === resource.id)
        state.arrObjCollections = payload
    },
    ELASTIC_SEARCH(state, payload){
        state.arrObjElasticSearchResult = payload
    }
}
export default mutations
