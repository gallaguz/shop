export default {
    state: {
        auth: false,
        id: null,
        username: null,
        phone: null,
        email: null
    },
    actions: {
        getApiProfile ({ commit }, id) {
            fetch(`/api/user/`, {
                method: 'POST',
                body: JSON.stringify({
                    action: 'getProfile'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {

                    console.log(res.profile);

                    commit('setProfile', res.profile);
                })
        },
        logIn({ commit }, {username, password, save}) {
            fetch(`/api/user/`, {
                method: 'POST',
                body: JSON.stringify({
                    action: 'login',
                    username: username,
                    password: password,
                    save: save
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    if (res.error === false) {
                        commit('doAuth', res.username
                        );
                    }
                });
        },
        logOut({ commit }) {
            fetch(`/api/user/`, {
                method: 'POST',
                body: JSON.stringify({
                    action: 'logout'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    if (res.error === false) {
                        commit('doLogOut');
                    }
                });
        },
        getApiOrders ({ commit }, id) {

        }
    },
    mutations: {
        doAuth (state, username ) {
            state.auth = true;
            state.username = username;
        },
        doLogOut (state) {
            state.auth = false;
        },
        setProfile (state, profile) {
            state.auth = profile.auth;
            state.user_id = profile.user_id;
            state.username = profile.username;
            state.phone = profile.phone;
            state.email = profile.email;
        }
    },
    getters: {
        getAuth(state){
            return state.auth;
        },
        getUserId(state) {
            return state.user_id;
        },
        getUsername(state){
            return state.username;
        },
        getPhone(state){
            return state.phone;
        },
        getEmail(state){
            return state.email;
        }
    }
}