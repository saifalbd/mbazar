import Vue from 'vue'
import Vuex from 'vuex';
import VuexORM from '@vuex-orm/core'
import {Category,Product,Price,Media,Brand,Variant,VariantOption,Warehouse} from '@/models/index.js';

import {
  axios,axiosWithoutToken
} from '@/plugins/axios';
// Create a new instance of Database.
const database = new VuexORM.Database()

Vue.use(Vuex)

// Register Models to Database.
database.register(Category)
database.register(Product)
database.register(Price)
database.register(Media)
database.register(Brand)
database.register(Variant)
database.register(VariantOption)
database.register(Warehouse)


export default new Vuex.Store({
  plugins: [VuexORM.install(database)],

  state: {
    pageTitle:'home',
    pageIcon:'home-circle',
    bread:[],
  
      user: null
    
  },
  mutations: {
    pageTitle (state, payload) {
      state.pageTitle = payload
    },
    pageIcon (state, payload) {
      state.pageIcon = payload
    },
    bread (state, payload) {
      const b = [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'breadcrumbs_dashboard',
        },
      ]
      state.bread = b.concat(payload);
    },
    setUserData (state, userData) {
      state.user = userData
      localStorage.setItem('user', JSON.stringify(userData))
      axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
      localStorage.setItem('token',`Bearer ${userData.token}`);
    },

    clearUserData () {
      localStorage.removeItem('user')
      localStorage.removeItem('token');
      location.reload()
    },
    setUser(state, userData){
      state.user = userData
    }

  },
  actions: {
    pageTitle(){},
    login ({ commit }, data) {
    

        commit('setUserData', data);
       
     
      
     
    },

    logout ({ commit }) {
      commit('clearUserData')
    }
  },
  getters : {
    isLogged: state => !!state.user
  }
  
})
