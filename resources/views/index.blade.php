<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <!-- Vuetify -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body>
    <v-app id="app">
        <v-app-bar app>
            <v-app-bar-nav-icon @click.stop="sidebarMenu = !sidebarMenu"></v-app-bar-nav-icon>
            <v-toolbar-title>Dashboard</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-icon>mdi-account</v-icon>
        </v-app-bar>

        <app-navbar :sidebar-menu="sidebarMenu" v-on:togglemenu="sidebarMenu = !sidebarMenu"></app-navbar>

        <v-main>
            <!-- 给应用提供合适的间距 -->
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