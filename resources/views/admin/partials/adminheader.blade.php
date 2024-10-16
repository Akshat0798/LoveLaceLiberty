<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{config('app.name')}}</title>

        <!-- Custom fonts for this template-->
        <link href="{{ asset('public/admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('public/admin_assets/css/sb-admin-2.css') }}" rel="stylesheet">

        <link href="{{ asset('public/admin_assets/vendor/select2/select2.css') }}" rel="stylesheet">
        <link href="{{ asset('public/admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ url('public/admin_assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon-16x16.png') }}">

        <style type="text/css">
            .loding_img {
              position: fixed;
              top: 0;
              z-index: 9999;
              width: 100%;
              height: 100%;
              background-color: rgba(0,0,0,.2);
            }
            .loding_img .loader {
              position: absolute;
              left: 50%;
              top: 50%;
              margin-left: -100px;
              margin-top: -100px;
            }
        </style>
    </head>

    <body id="page-top">
        <div class="loding_img" style="display: none;">
            <div class="loader">
                <img src="{{ url('public/loader.gif') }}">
            </div>
        </div>
        <!-- Page Wrapper -->
        <div id="wrapper">
