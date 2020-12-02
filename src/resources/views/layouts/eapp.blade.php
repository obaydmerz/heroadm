<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{env('APP_NAME')}} Admin | @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet"
            href="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
    
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}  ">
    
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/chart.js/chart.min.css') }}  ">
    
        <!-- JQVMap -->
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/jqvmap/jqvmap.min.css') }}  ">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dashboard/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
    
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}  ">
        <!-- Daterange picker -->
    
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/daterangepicker/daterangepicker.css') }}  ">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- summernote -->
        <link rel="stylesheet" href=" {{ asset('dashboard/plugins/summernote/summernote-bs4.css') }}  ">
    
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
        @if(App::getLocale() == 'ar')
        <style>
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: Cairo, sans-serif !important
            }
        </style>
    
        <!-- Google Font: Cairo -->
        <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,400i,700" rel="stylesheet">
    
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
        @endif
    
    </head>

<body class="login-page" style="height: auto; min-height: 100%;">
    @include('littleadm.includes.sweet')
    @yield('content')



    <script src=" {{ asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->

    <script src=" {{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>



    <!-- Bootstrap 4 -->

    <script src=" {{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->

    <script src=" {{ asset('dashboard/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->

    <script src=" {{ asset('dashboard/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src=" {{ asset('dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src=" {{ asset('dashboard/plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
    <!-- jQuery Knob Chart -->

    <script src=" {{ asset('dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->

    <script src=" {{ asset('dashboard/plugins/moment/moment.min.js')}}"></script>

    <script src=" {{ asset('dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->

    <script src=" {{ asset('dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>
    <!-- Summernote -->

    <script src=" {{ asset('dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->

    <script src=" {{ asset('dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('dashboard/js/adminlte.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <script src=" {{ asset('dashboard/js/pages/dashboard.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script src=" {{ asset('dashboard/js/demo.js')}}"></script>
    <script>
        // Definitions
        window.littleadm.csrf = "{{ csrf_token() }}";
    </script>
    @yield('scripts')
</body>

</html>