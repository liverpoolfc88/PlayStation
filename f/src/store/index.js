import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  state: {
    backend_url: 'http://playstation.loc/',
    // access_token: Cookies.get('access_token') || "null",
    user: null,
    // permissions: null,
    // locale: Cookies.get('locale') || 'ru',
    errors: [],
    redirect_url: null,
    document_list: [],
    notifications: {}
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
