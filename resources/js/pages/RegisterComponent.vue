<template>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <form class="form-signin">
                    <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
                    <input v-model="credentials.name"
                           name="name"
                           type="text"
                           class="form-control mb-2"
                           placeholder="Name"
                           required autofocus>
                    <input v-model="credentials.email"
                           name="email"
                           type="email"
                           class="form-control mb-2"
                           placeholder="Email address"
                           required>
                    <input v-model="credentials.password"
                           type="password"
                           class="form-control mb-2"
                           placeholder="Password"
                           required>
                    <input v-model="credentials.password_confirmation"
                           type="password"
                           class="form-control mb-2"
                           placeholder="Password Confirmation"
                           required>

                    <button v-on:click="register"
                            class="btn btn-lg btn-primary btn-block"
                            type="button">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RegisterComponent",

        data: function () {
            return {
                credentials: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }

            }
        },

        methods: {
            register: function () {
                this.$store.commit('register', this.credentials);
            }
        }
    }
</script>

<style scoped>
    .container {
        margin-top: 200px;
    }
</style>
