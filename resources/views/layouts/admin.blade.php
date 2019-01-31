<!DOCTYPE html>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>
    <link href="{{asset('administrator/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('administrator/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('administrator/css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('administrator/css/styles.css')}}" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('administrator/js/html5shiv.js')}}"></script>
    <script src="{{asset('administrator/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
            <ul class="nav navbar-top-links navbar-right">
                <li><a href="{{route('main_page')}}">Вернуться на сайт</a></li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>

@include('partials.admin_sidebar')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    @yield('content')

</div>	<!--/.main-->

<script src="{{asset('administrator/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('administrator/js/bootstrap.min.js')}}"></script>
<script src="{{asset('administrator/js/chart.min.js')}}"></script>
<script src="{{asset('administrator/js/chart-data.js')}}"></script>
<script src="{{asset('administrator/js/easypiechart.js')}}"></script>
<script src="{{asset('administrator/js/easypiechart-data.js')}}"></script>
<script src="{{asset('administrator/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('administrator/js/custom.js')}}"></script>
<script src="{{asset('administrator/js/sg-admin-script.js')}}"></script>

</body>
</html>