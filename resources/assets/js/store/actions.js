let actions = {
    createResource({commit}, objResource,config) {
        // console.log(objResource)
        // console.log(config)
        axios.post('/api/resources', objResource,config)
            .then(response => {
                commit('CREATE_RESOURCE', response.data)
                window.location.reload();
            }).catch(error => {
            console.log(error)
        })

    },

    addCollectionToResource({commit},  payload) {
        axios.post('/api/resources/'+payload.intResourceId,payload.resource)
            .then(response => {
                commit('ADD_REMOVE_COLLECTION_TO_RESOURCE', {objResource: response.data})
            }).catch(error => {
            console.log(error)
        })

    },

    removeCollectionToResource({commit},  payload) {
        axios.post('/api/resources/remove/'+payload.intResourceId,payload.resource)
            .then(response => {
                commit('ADD_REMOVE_COLLECTION_TO_RESOURCE', {objResource: response.data})
            }).catch(error => {
            console.log(error)
        })

    },
    fetchResourcesCollections({commit}) {
        axios.get('/api/resources')
            .then(response => {
                commit('FETCH_RESOURCES_COLLECTIONS', response.data)
            }).catch(error => {
             console.log(error)
        })
    },
    fetchCollectionsResources({commit}) {
        axios.get('/api/collections')
            .then(response => {
                commit('FETCH_COLLECTIONS_RESOURCES', response.data)
            }).catch(error => {
            console.log(error)
        })
    },
    deleteResource({commit}, objResource) {
        axios.delete(`/api/resources/${objResource.id}`)
            .then(response => {
                if (response.data === 'ok')
                    commit('DELETE_RESOURCE', resource)
                window.location.reload();
            }).catch(error => {
            // console.log(error)
        })
    },
    updateResource({commit}, objResource) {
        axios.post('/api/resources/update/'+objResource.id,objResource)
            .then(response => {
                if (response.data === 'ok')
                    commit('UPDATE_RESOURCE', resource)
                window.location.reload();
            }).catch(error => {
            console.log(error)
        })
    },
    createCollection({commit}, collection) {
        axios.post('/api/collections', collection)
            .then(response => {
                commit('CREATE_COLLECTION', response.data)
                window.location.reload();
            }).catch(error => {
            console.log(error)
        })

    },
    deleteCollection({commit}, collection) {
        axios.delete(`/api/collections/${collection.id}`)
            .then(response => {
                if (response.data === 'ok')
                    commit('DELETE_COLLECTION', collection)
                window.location.reload();
            }).catch(error => {

        })
    },
    updateCollection({commit}, collection) {
        axios.post('/api/collections/update/'+collection.id,collection)
            .then(response => {
                if (response.data === 'ok')
                    commit('UPDATE_COLLECTION', collection)
                window.location.reload();
            }).catch(error => {
            console.log(error)
        })
    },
    addResourceToCollection({commit},  payload) {
        axios.post('/api/collections/'+payload.intCollectionId,payload.collection)
            .then(response => {
                commit('ADD_REMOVE_RESOURCE_TO_COLLECTION', {objCollection: response.data})
            }).catch(error => {
            console.log(error)
        })

    },

    removeResourceToCollection({commit},  payload) {
        axios.post('/api/collections/remove/'+payload.intCollectionId,payload.collection)
            .then(response => {
                commit('ADD_REMOVE_RESOURCE_TO_COLLECTION', {objCollection: response.data})
            }).catch(error => {
            console.log(error)
        })

    },
    addToResourceFavortted({commit}, resource) {

        axios.post('/api/resources/add_to_favortted/' + resource.id, resource)
            .then(response => {
                    commit('FAVORITES_RESOURCE', {id: response.data.id})
            }).catch(error => {
            console.log(error)
        })
    },
    // searchResource({commit}, resource) {
    //     axios.post('/resources/search' , resource)
    //         .then(response => {
    //             commit('SEARCH_RESOURCE', response)
    //             // console.log(response)
    //         }).catch(error => {
    //         console.log(error)
    //     })
    // },
    searchResourceCollection({commit}, search) {
        axios.post('/resources/search/data' , search)
            .then(response => {
                commit('SEARCH_RESOURCE_COLLECTION', response.data)
            }).catch(error => {
            console.log(error)
        })
    },
    addToCollectionFavortted({commit}, collection) {

        axios.post('/api/collections/add_to_favortted/' + collection.id, collection)
            .then(response => {
                commit('FAVORITES_COLLECTION', {id: response.data.id})
            }).catch(error => {
            console.log(error)
        })
    },

    elasticSearchData({commit}, payload) {
        axios.post('/elasticsearch' ,payload)
            .then(response => {
                commit('ELASTIC_SEARCH',response.data)

            }).catch(error => {
            console.log(error)
        })
    }
}

export default actions
