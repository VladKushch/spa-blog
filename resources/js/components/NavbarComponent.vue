<template>
    <nav class="navbar navbar-dark bg-primary">
        <a v-on:click="goToAppPage"
           class="navbar-brand"
           href="#">
            SPA Blog
        </a>
        <form class="form-inline">
            <a v-on:click="goToLoginPage"
               v-if="!loggedIn"
               class="navbar-brand"
               href="#">
                Login
            </a>
            <a v-on:click="goToRegisterPage"
               v-if="!loggedIn"
               class="navbar-brand"
               href="#">
                Register
            </a>
            <a v-on:click="logOut"
               v-if="loggedIn"
               class="navbar-brand"
               href="#">
                LogOut
            </a>
        </form>
    </nav>
</template>

<script>
    export default {
        name: "NavbarComponent",

        methods: {
            goToAppPage: function () {
                this.$store.commit('goToPage', 'app');
            },
            goToLoginPage: function () {
                this.$store.commit('goToPage', 'login');
            },
            goToRegisterPage: function () {
                this.$store.commit('goToPage', 'register');
            },
            logOut: function () {
                this.$store.commit('logOut');
            }
        },

        computed: {
            loggedIn: function () {
                return this.$store.state.auth.loggedIn;
            }
        }
    }
</script>

<style scoped>

</style>
