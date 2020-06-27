import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import moduleAuth from './moduleAuth';
import modulePosts from './modulePosts';

const store = new Vuex.Store({
    modules: {
        auth: moduleAuth,
        posts: modulePosts,
    }
});

export default store;
