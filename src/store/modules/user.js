import Axios from "axios";

export default {
    state: {
        auth: false,
        profile: false,
        id: null,
        username: null,
        phone: null,
        email: null
    },
    actions: {
        getApiProfile ({ commit }) {
            Axios.post(
                '/api/user/',
                {
                    action: 'getProfile'
                }
            ).then((response) => {
                commit('setProfile', response.data.profile);
            });
        },
        logIn({ commit }, {username, password, save}) {
            Axios.post(
                '/api/user/',
                {
                    action: 'login',
                    username: username,
                    password: password,
                    save: save
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('doAuth', response.data.username
                    );
                }
            });
        },
        logOut({ commit }) {
            Axios.post(
                '/api/user/',
                {
                    action: 'logOut'
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('doLogOut');
                }
            });
        }
    },
    mutations: {
        doAuth (state, username ) {
            state.auth = true;
            state.username = username;
        },
        doLogOut (state) {
            state.auth = false;
            state.user_id = false;
            state.username = false;
            state.phone = false;
            state.email = false;
        },
        setProfile (state, profile) {
            state.auth = profile.auth;
            state.profile = profile;
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
        getProfile(state){
            return state.profile;
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