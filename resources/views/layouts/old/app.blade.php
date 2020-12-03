<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}} Admin | {{$title}}</title>
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

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <link rel="stylesheet" href=" {{ asset('dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}  ">
    <!-- Daterange picker -->

    <link rel="stylesheet" href=" {{ asset('dashboard/plugins/daterangepicker/daterangepicker.css') }}  ">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- summernote -->
    <link rel="stylesheet" href=" {{ asset('dashboard/plugins/summernote/summernote-bs4.css') }}  ">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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

    @if(App::getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
    @endif

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('heroadm.dashboard')}}" class="nav-link">@lang('heroadm/site.dashboard')</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
            </ul>

            {{-- <!-- SEARCH FORM -->
            <form class="form-inline ml-3" action="{{route('heroadm.users.search')}}" method="GET">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search Users..."
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}
            <!-- Right navbar links -->
            <ul class="navbar-nav @if(App::getLocale() != 'ar') ml-auto @endif" @if(App::getLocale() == "ar") style="margin-right: auto!important;" @endif>
                <!-- Messages Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('dashboard/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('dashboard/img/user8-128x128.jpg')}}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('dashboard/img/user1-128x128.jpg')}}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li> --}}
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"
                        data-toggle="dropdown">
                        <i class="far fa-bell @if(auth()->user()->unreadNotifications->count()) text-danger @endif"></i>
                        @if(auth()->user()->unreadNotifications->count())
                            <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @if(auth()->user()->unreadNotifications->count())
                            <li class="dropdown-item text-danger">You have {{auth()->user()->unreadNotifications->count()}} notifications</li>
                        @endif
                        @foreach(auth()->user()->unreadNotifications as $ntf)
                            <a href="{{route('heroadm.ntfs.markasread', ['id' => $ntf->id])}}" class="dropdown-item">
                                <i class="fas fa-bell text-danger"></i> {{$ntf->data['data']}}
                            </a>
                        @endforeach
                        @foreach(auth()->user()->readNotifications as $ntf)
                            <a href="{{route('heroadm.ntfs.delete', ['id' => $ntf->id])}}" class="dropdown-item">
                                <i class="fas fa-bell"></i> {{$ntf->data['data']}}
                            </a>
                        @endforeach
        
                        <div class="dropdown-item row">
                                @if(auth()->user()->unreadNotifications->count())
                                    <a href="{{route('heroadm.ntfs.allread')}}" style="border: none;" class="btn btn-defualt col-6">
                                        Mark All as Readed
                                    </a>
                                @endif
                                @if(auth()->user()->readNotifications->count())
                                    <a href="{{route('heroadm.ntfs.alldelete')}}" style="border: none;" class="btn btn-danger col-6">
                                        Delete Readed
                                    </a>
                                @endif
                                @if(!(auth()->user()->unreadNotifications->count() || auth()->user()->readNotifications->count()))
                                    <a class="col-12">
                                        Empty Inbox
                                    </a>
                                @endif
                        </div>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('heroadm.logout')}}">
                        <i class="fas fa-door-open"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-flag"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('heroadm.layouts._aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('heroadm.includes.sweet')
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright © 2020-{{date('Y')}} <a href="{{route('heroadm.dashboard')}}">LittleADM</a>.</strong> All rights
            reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    {{-- <script src=" {{ asset('js/app.js')}}"></script> --}}
    <script src=" {{ asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->

    <script src=" {{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>



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
        window.heroadm.csrf = "{{ csrf_token() }}";
    </script>
    @yield('scripts')
</body>

</html>