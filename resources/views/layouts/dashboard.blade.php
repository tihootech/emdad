<!DOCTYPE html>
<html lang="fa">

<head>

    <?php // TODO: dont forget to fix the head ?>
    <title> @yield('title', 'پنل مدیریت') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <?php // TODO: favicon ?>
    <link href="{{asset('landing/img/brand/favicon.ico')}}" rel="icon" type="image/png">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/font-awesome.min.css")}}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/fonts.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/pdp.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("dashboard/css/dashmain.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/main.css")}}">

</head>

<body class="app sidebar-mini rtl">

    @include("dashboard.header")
    @include("dashboard.aside")

    <main class="app-content">
        @include('partials.messages')
        @include('partials.errors')
        @yield('main')
    </main>

    <!-- Essential javascripts for application to work-->
    <script src="{{asset("dashboard/js/jquery-3.2.1.min.js")}}"></script>
    <script src="{{asset("dashboard/js/jq-ui.js")}}"></script>
    <script src="{{asset("dashboard/js/popper.min.js")}}"></script>
    <script src="{{asset("dashboard/js/bootstrap.min.js")}}"></script>

    <!-- Plugins -->
    <script src="{{asset("dashboard/js/plugins/pace.min.js")}}"></script>
    <script src="{{asset("dashboard/js/plugins/sweetalert.min.js")}}"></script>
    <script src="{{asset("dashboard/js/plugins/select2.min.js")}}"></script>

    <!-- Main -->
    <script src="{{asset("dashboard/js/cats-treeview.js")}}"></script>
    <script src="{{asset("js/pdp.min.js")}}"></script>
    <script src="{{asset("dashboard/js/dashmain.js")}}"></script>
    <script src="{{asset("dashboard/js/plugins/chart.js")}}"></script>

</body>

</html>
