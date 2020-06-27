<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>SPA Blog</title>
    </head>
    <body>
    <div id="app">
        <navbar-component></navbar-component>
        <login-component v-if="$store.state.auth.state == 'login'"></login-component>
        <register-component v-if="$store.state.auth.state == 'register'"></register-component>
        <app-component v-if="$store.state.auth.state == 'app'"></app-component>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
