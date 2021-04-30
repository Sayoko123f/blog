<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
</head>

<body>
    <div id="app">
        <v-app>
            <v-navigation-drawer app>
                <!-- -->
            </v-navigation-drawer>

            <v-app-bar app>
                <!-- -->
            </v-app-bar><!-- 根据应用组件来调整你的内容 -->
            <v-main>
                <!-- 给应用提供合适的间距 -->
                <v-container fluid>
                    <!-- 如果使用 vue-router -->
                    <router-view></router-view>
                </v-container>
            </v-main>

            <v-footer app>
                <!-- -->
            </v-footer>
        </v-app>
    </div>
    <script src="{{asset('js/app.js')}}" defer></script>
</body>

</html>