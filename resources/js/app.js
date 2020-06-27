/**
 *   Imports
 */
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import Router from 'vue-router'

import store from './store/store.js'

/**
*   Config
*/
Vue.use(Router);
Vue.use(Vuex);
const instance = axios.create({
    baseURL: 'https://localhost/api/',
    timeout: 1000,
    headers: {'X-Custom-Header': 'XMLHttpRequest'}
});

/**
 *   Vuex
 */

console.log(store.state.auth.message);

/**
 *   Vue Components
 */
Vue.component('login-component', require('./pages/LoginComponent.vue').default);
Vue.component('register-component', require('./pages/RegisterComponent.vue').default);
Vue.component('app-component', require('./pages/AppComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);

/**
 *   Vue Instance
 */
const app = new Vue({
    el: '#app',
    store: store,
});
