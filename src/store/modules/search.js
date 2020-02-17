import Axios from "axios";

export default {
    state: {
        items: [],
        query: ''
    },
    actions: {
        searchApi ({ commit, state }, query) {
            Axios.post(
                '/api/product/',
                {
                    action: 'search',
                    query: query
                }
            ).then((response) => {
                commit('setQuery', query);
                commit('setFilteredItems', response.data.items);
            });
        },
        clearQuery ({ commit }) {
            commit('setQuery', '');
        }
    },
    mutations: {
        setFilteredItems (state, items) {
            state.items = items;
        },
        setQuery (state, query) {
            state.query = query;
        }
    },
    getters: {
        getFilteredItems(state) {
            return state.items;
        },
        getQuery(state) {
            return state.query;
        }
    }
}
