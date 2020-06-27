import axios from 'axios';
const instance = axios.create({
    baseURL: 'http://localhost/api/',
    timeout: 10000,
    headers: {'X-Custom-Header': 'XMLHttpRequest'}
});

const moduleAuth = {
    state: () => ({
        state: 'app', // login, register, app
        token: null,
        user: null,
        loggedIn: false
    }),

    mutations: {
        goToPage (state, page) {
            state.state = page;
        },
        logIn (state, credentials) {
            instance
                .post('login', credentials)
                .then(response => {
                    state.user = response.data.user;
                    state.token = {headers: {Authorization: `Bearer ${response.data.access_token}`}};
                    state.loggedIn = true;
                    state.state = 'app'
                })
                .catch(error => console.log(error));
        },
        logOut (state) {
            instance
                .post('logout', {}, state.token)
                .then(response => {
                    state.user = null;
                    state.token = null;
                    state.loggedIn = false;
                    state.state = 'app'
                })
                .catch(error => console.log(error));
        },
        register (state, credentials) {
            instance
                .post('register', credentials)
                .then(response => {
                    state.user = response.data.user;
                    console.log(response.data);
                })
                .catch(error => console.log(error));
        },
    },
}
export default moduleAuth;

