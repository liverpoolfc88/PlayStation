import Vue from 'vue';
import Vuex from 'vuex';
import Cookies from 'js-cookie';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: true,
    state: {
        backend_url: 'http://plstation.sar/',
        access_token: Cookies.get('access_token') || "null",
        locale: Cookies.get('locale') || 'en',
        user: null,
        permissions: null,
    },
    getters: {
        checkPermission: (state) => (permission) => {
            let localStorage = window.localStorage;

            let permissions = JSON.parse(localStorage.getItem('permissions'));
            if (permissions)
                return permissions.find(v => v == permission);
            return false;
            //     let permissions = state.permissions;
            //     if (permissions)
            //         return permissions.find(v => v == permission);
            //     return false;
        },
        getAccessToken: (state) => () => {
            let localStorage = window.localStorage;
            let access_token = localStorage.getItem('access_token');
            if (access_token)
                return access_token;
            return false;
        },
    },
    modules: {},
    mutations: {
        setUser: (state, arg) => {
            state.user = arg;
        },
        setAccessToken: (state, arg) => {
            let localStorage = window.localStorage;
            localStorage.setItem('access_token', arg);
        },
        setPermissions: (state, arg) => {
            let localStorage = window.localStorage;
            localStorage.setItem('permissions', JSON.stringify(arg));
        },
        setRedirectUrl(state, arg) {
            state.redirect_url = arg
        },
    },
    actions: {
        setLocale: (state, arg) => {
            Cookies.set('locale', arg)
        },
        setPermissions: (context, arg) => {
            context.commit('setPermissions', arg)
        },
        setUser: (context, arg) => {
            context.commit('setUser', arg)
        },
        setAccessToken: (context, arg) => {
            context.commit('setAccessToken', arg)
        },
        setRedirectUrl: (context, arg) => {
            context.commit('setRedirectUrl', arg)
        },
    },
});