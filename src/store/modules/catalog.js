export default {
    state: {
        catalog: [],
        page: 0
    },
    actions: {
        getApiCatalog ({ commit }) {
            fetch('/api/product/', {
                method: 'POST',
                body: JSON.stringify({
                    action: 'catalog',
                    page: this.page
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    commit('setPage', res.page);
                    commit('setCatalog', res.catalog);
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
