import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)


export default new Vuex.Store({
    strict: true,
    state: {
        searchFilters: {
            title: "",
            description: ""
        }
    },
    mutations: {
        updateSearchFilters(state, data) {
            state.searchFilters = data
        },
        resetSearchFilters(state) {
            Object.keys(state.searchFilters).forEach(function (key){
                state.searchFilters[key] = ''
            });
        }
    },
    actions: {
        createResource(state, data) {
            axios.post('http://127.0.0.1:8000/resources', input).then(function (response) {
                _this.items = response.data;
            });
        }
    },
    getters: {

    }
});
