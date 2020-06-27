<template>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <form class="form-signin">
                    <h1 class="h3 mb-3 font-weight-normal">Log In</h1>
                    <input v-model="credentials.email"
                           name="email"
                           type="email"
                           class="form-control mb-2"
                           placeholder="Email address"
                           required autofocus>
                    <input v-model="credentials.password"
                           name="password"
                           type="password"
                           class="form-control mb-2"
                           placeholder="Password"
                           required>

                    <button v-on:click="logIn"
                            v-on:keypress.enter="logIn"
                            class="btn btn-lg btn-primary btn-block"
                            type="button">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LoginComponent",

        data: function () {
            const vm = this;
            return {
                credentials: {
                    email: '',
                    password: '',
                }
            }
        },

        methods: {
            logIn: function () {
                this.$store.commit('logIn', this.credentials);
            }
        }
    }
</script>

<style scoped>
    .container {
        margin-top: 200px;
    }
</style>
