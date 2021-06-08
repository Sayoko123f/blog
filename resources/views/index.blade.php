<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '網頁開發筆記') }}</title>
    <!-- Vuetify -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
</head>

<body>
    <v-app id="app">
        <v-app-bar app>
            <v-toolbar-title>
                <router-link to="/"><span class="toolbar-title">網頁開發筆記</span></router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-spacer></v-spacer>
            <v-spacer></v-spacer>
            <v-spacer></v-spacer>
            <search-bar></search-bar>
            <v-app-bar-nav-icon @click.stop="sidebarMenu = !sidebarMenu" class="ml-1"></v-app-bar-nav-icon>
        </v-app-bar>
        <app-navbar :sidebar-menu="sidebarMenu" v-on:togglemenu="menuToggle"></app-navbar>
        <v-main>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
        <v-footer app>
            <!-- -->
        </v-footer>
    </v-app>
    <script src="{{asset('js/app.js')}}" defer></script>
</body>

</html>