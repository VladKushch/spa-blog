import axios from 'axios';
const instance = axios.create({
    baseURL: 'http://localhost/api/blog/',
    timeout: 10000,
    headers: {'X-Custom-Header': 'XMLHttpRequest'}
});
const instanceNoUrl = axios.create({
    timeout: 10000,
    headers: {'X-Custom-Header': 'XMLHttpRequest'}
});

const modulePosts = {
    state: () => ({
        posts: null,
    }),

    mutations: {
        posts (state, posts) {
            state.posts = posts;
        },
        postResp (state, postResp) {
            state.postResp = postResp;
        }
    },

    actions: {
        posts : async ({commit}, link) => {
            let response = await instanceNoUrl.get(link);

            if (response.status == 200) {
                commit('posts', response.data[0]);
            }
        },
        storePost : async ({rootState}, newPost) => {
            let response = await instance.post('store', newPost, rootState.auth.token);
        },
        updatePost : async ({rootState}, data) => {
            let response = await instance.post(`update/${data.id}`, data.post, rootState.auth.token);
        },
        destroyPost : async ({rootState}, postId) => {
            let response = await instance.post(`destroy/${postId}`, {}, rootState.auth.token);
        },
    }
}
export default modulePosts;

