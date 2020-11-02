import Vue from "vue";
import App from "@/App.vue";
import router from '@/router'
import store from '@/store';
import vuetify from '@/plugins/vuetify';
import '@/plugins/validate.js'
Vue.config.productionTip = false;



import '../styles.scss';
import '@/assets/scss/default/style.scss';




new Vue({
  router,
  store,
  render: (h) => h(App),

  data:{
    
    // res:res.data
  },

  vuetify,

 created(){

    



  }
}).$mount("#app");
  





