<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('backend_resource/img/logo/logo.png') }}" rel="icon">
    <title>Sales Inventory - Dashboard</title>
    <link href="{{ asset('resource_backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('resource_backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('resource_backend/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body id="page-top">
<div id="app">
    <div id="wrapper">

        <!-- Sidebar -->
            @include('includes.sidebar')
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
           <!-- Main Content -->
            @yield('content')
                @include('includes.mainContent')
           <!-- Main Content -->
        </div>
    </div>
</div>
<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('resource_backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('resource_backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('resource_backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('resource_backend/js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('resource_backend/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('resource_backend/js/demo/chart-area-demo.js') }}"></script>
<script type="text/javascript">
    let token = localStorage.getItem('token');

    if(token){
        $("#sidebar").css("display", "");
        $("#topbar").css("display", "");
    }
</script>
</body>

</html>
