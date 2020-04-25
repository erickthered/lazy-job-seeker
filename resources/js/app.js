require('./bootstrap')

import Vue from 'vue'
import vuetify from './plugins/vuetify'
import store from './plugins/store'
import router from './plugins/router'

import App from './App'

const app = new Vue({
    vuetify,
    router,
    store,
    el: '#app',
    render: h => h(App)  
})