<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

   

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">    

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon-16x16.png') }}">

    <!-- Styles -->
<!--     <link href="{{ asset('admin/sdf.ccf ') }}" rel="stylesheet"> -->   
</head>
<body class="bg-gradient-primary">
   <div class="container">
    @yield('content')
   </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
