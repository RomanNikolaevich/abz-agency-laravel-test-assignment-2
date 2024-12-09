import {createStore} from 'vuex';

export default createStore({
    state: {
        authToken: localStorage.getItem('token') || null,
    },
    mutations: {
        setAuthToken(state, token) {
            state.authToken = token;
            if (token) {
                localStorage.setItem('token', token);
            } else {
                localStorage.removeItem('token');
            }
        },
    },
    actions: {
        updateToken({commit}, token) {
            commit('setAuthToken', token);
        },
    },
});
