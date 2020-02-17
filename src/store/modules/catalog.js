import Axios from "axios";

export default {
    state: {
        catalog: [],
        page: 0
    },
    actions: {
        getApiCatalog ({ commit, state }) {
            Axios.post(
                '/api/product/',
                {
                    action: 'catalog',
                    page: state.page
                }
            ).then((response) => {
                commit('setPage', response.data.page);
                commit('setCatalog', response.data.catalog);
            });
        }
    },
    mutations: {
        setCatalog (state, catalog) {
            state.catalog = catalog;
        },
        setPage (state, page) {
            state.page = page;
        },
    },
    getters: {
        getCatalog(state) {
            return state.catalog
        }
    }
}
