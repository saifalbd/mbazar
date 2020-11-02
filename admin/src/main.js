import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import 'roboto-fontface/css/roboto/roboto-fontface.css';
import './plugins/validate.js'

import lodash from 'lodash'

window._ = lodash;


Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  data:{
    isMobile:false,
  },
  render: h => h(App),
  beforeDestroy () {
    if (typeof window === 'undefined') return

    window.removeEventListener('resize', this.onResize, { passive: true })
  },

  mounted () {
    this.onResize()

    window.addEventListener('resize', this.onResize, { passive: true })
  },
  methods: {
  
    onResize () {
      this.isMobile = window.innerWidth < 600
    },
}

}).$mount('#app');

