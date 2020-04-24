require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter);

import VueAxios from 'vue-axios'
import axios from 'axios'
Vue.use(VueAxios, axios);

import {routes} from './routes'
const router = new VueRouter({
    mode:'history',
    routes
});

import App from './App.vue';
// const app = new Vue(Vue.util.extend({router}, App)).$mount('#app');
new Vue({
    el:'#app',
    render:h=>h(App),
    router,
    data(){
        return{
            routes: routes
        }
    }
});
