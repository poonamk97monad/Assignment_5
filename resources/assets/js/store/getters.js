let getters = {
    resources: state => {
        return state.resources
    },
    resourcesview: state => {
        return state.resourcesview
    },
    arrObjCollections: state => {
        return state.arrObjCollections
    },
    arrObjResources: state => {
        return state.arrObjResources
    },
    intResourceId: state => {
        return state.intResourceId
    },
    collections: state => {
    return state.collections
    },
}

export default  getters
