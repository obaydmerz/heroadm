<!DOCTYPE html>
<!-- saved from url=(0047)https://adminlte.io/themes/AdminLTE/index2.html -->
<html style="height: auto; min-height: 100%;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}} Admin | {{$title}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href=" {{ asset('dashboard/css/bootstrap.min.css') }}  ">



    <link rel="stylesheet" href=" {{ asset('dashboard/css/jquery-jvectormap.css') }}  ">
    <link rel="stylesheet" href=" {{ asset('dashboard/css/AdminLTE.min.css') }}  ">
    <link rel="stylesheet" href=" {{ asset('dashboard/css/_all-skins.min.css') }}  ">

    <style>
        svg {
            display: inline-block;
        }

        .sidebar-menu>li>a>svg {
            width: 22px !important
        }

        .sidebar-menu li>a>.fa-angle-left,
        .sidebar-menu li>a>.pull-right-container>.fa-angle-left {
            width: 7px !important;
        }
    </style>



    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



    <style type="text/css">
        .jqstooltip {
            position: absolute;
            left: 0px;
            top: 0px;
            visibility: hidden;
            background: rgb(0, 0, 0) transparent;
            background-color: rgba(0, 0, 0, 0.6);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
            -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
            color: white;
            font: 10px arial, san serif;
            text-align: left;
            white-space: nowrap;
            padding: 5px;
            border: 1px solid white;
            box-sizing: content-box;
            z-index: 10000;
        }

        .jqsfield {
            color: white;
            font: 10px arial, san serif;
            text-align: left;
        }
    </style>
    {{-- <link rel="stylesheet" href="https://themeon.net/nifty/v2.9.1/plugins/ionicons/css/ionicons.min.css"> --}}
</head>

<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">

        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{{env('APP_MINI_NAME', 'LAD')}}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>{{env('APP_NAME', 'Laravel')}}</b> Admin</span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle"
                    data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        {{-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle"
                                data-toggle="dropdown">
                                <i class="far fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{asset('dashboard/img/user2-160x160.jpg')}}"
                                                        class="img-circle" alt="">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="far fa-clock"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{asset('dashboard/img/user1-128x128.jpg')}}"
                                                        class="img-circle" alt="">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="far fa-clock"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="./AdminLTE 2 _ Dashboard_files/user4-128x128.jpg"
                                                        class="img-circle" alt="">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fas fa-clock"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{asset('dashboard/img/user1-128x128.jpg')}}"
                                                        class="img-circle" alt="">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fas fa-clock"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="./AdminLTE 2 _ Dashboard_files/user4-128x128.jpg"
                                                        class="img-circle" alt="">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fas fa-clock"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All
                                        Messages</a></li>
                            </ul>
                        </li> --}}
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle"
                                data-toggle="dropdown">
                                <i class="far fa-bell"></i>
                                @if(auth()->user()->unreadNotifications->count())
                                    <span class="label label-warning">{{auth()->user()->unreadNotifications->count()}}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->unreadNotifications->count())
                                    <li class="header">You have {{auth()->user()->unreadNotifications->count()}} notifications</li>
                                @endif
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        @foreach(auth()->user()->unreadNotifications as $ntf)
                                            <li>
                                                <a href="{{route('heroadm.ntfs.markasread', ['id' => $ntf->id])}}">
                                                    <i class="fas fa-bell text-danger"></i> {{$ntf->data['data']}}
                                                </a>
                                            </li>
                                        @endforeach
                                        @foreach(auth()->user()->readNotifications as $ntf)
                                            <li>
                                                <a href="{{route('heroadm.ntfs.delete', ['id' => $ntf->id])}}">
                                                    <i class="fas fa-bell"></i> {{$ntf->data['data']}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="footer">
                                    @if(auth()->user()->unreadNotifications->count())
                                        <a href="{{route('heroadm.ntfs.allread')}}">
                                            Mark All as Readed
                                        </a>
                                    @endif
                                    @if(auth()->user()->readNotifications->count())
                                        <a href="{{route('heroadm.ntfs.alldelete')}}">
                                            Delete Readed
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle"
                                data-toggle="dropdown">
                                <i class="far fa-flag"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle"
                                data-toggle="dropdown">
                                <img src="{{auth()->user()->getPicture() ? auth()->user()->getPicture() : asset('dashboard/img/user2-160x160.jpg')}}" class="user-image"
                                    alt="">
                                <span class="hidden-xs">{{auth()->user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{auth()->user()->getPicture() ? auth()->user()->getPicture() : asset('dashboard/img/user2-160x160.jpg')}}" class="img-circle"
                                        alt="">

                                    <p>
                                        {{auth()->user()->name}}
                                        <small>{{auth()->user()->role == 'admin' ? 'Admin In ' . env('APP_NAME', 'Laravel') : 'User In ' . env('APP_NAME', 'Laravel')}}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                {{-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li> --}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{route('heroadm.logout')}}"
                                            class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i
                                    class="fas fa-cogs"></i></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height: auto;">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{auth()->user()->getPicture() ? auth()->user()->getPicture() : asset('dashboard/img/user2-160x160.jpg')}}" class="img-circle" alt="">
                    </div>
                    <div class="pull-left info">
                        <h5>{{auth()->user()->name}}</h5>
                </div>
    </div>
    <!-- search form -->
    <form action="{{route('heroadm.users.search')}}" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search Users...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fas fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">General</li> {{-- General Main Navigation --}}
        <li>
            @if(Route::has('heroadm.dashboard'))
                <a href="{{route('heroadm.dashboard')}}">
                    <i class="fas fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            @endif
        </li>
        <li class="header">Site</li> {{-- Site Main Navigation --}}
        @if(Route::has('heroadm.users'))
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i> <span>Site</span>
                    <span class="pull-right-container">
                        <i class="fas fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(Route::has('heroadm.users'))
                        <li>
                            <a href="{{route('heroadm.users')}}"><i class="far fa-circle"></i>
                                Users
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(Route::has('heroadm.media') || Route::has('heroadm.media.upload') || Route::has('heroadm.media.new'))
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-image"></i>
                    <span>Media</span>
                    {{-- <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span> --}}
                </a>
                <ul class="treeview-menu">
                    <li>
                        @if(Route::has('heroadm.media'))
                            <a href="{{route('heroadm.media', ['path' => '/'])}}"><i class="far fa-circle"></i>
                                Media Browser
                            </a>
                        @endif
                        @if(Route::has('heroadm.media.upload'))
                            <a href="{{route('heroadm.media.upload')}}"><i class="far fa-circle"></i>
                                Upload Media
                            </a>
                        @endif
                        @if(Route::has('heroadm.media.new'))
                            <a href="{{route('heroadm.media.new')}}"><i class="far fa-circle"></i>
                                New Media
                            </a>
                        @endif
                    </li>
                </ul>
            </li>
        @endif
        @if(Route::has('heroadm.menubuilder'))
            <li>
                <a href="{{route('heroadm.menubuilder')}}">
                    <i class="fas fa-box"></i> <span>Menu Bulider</span>
                </a>
            </li>
        @endif
        @if(Route::has('heroadm.configs'))
            <li>
                <a href="{{route('heroadm.configs')}}">
                    <i class="fas fa-cogs"></i> <span>Configs</span>
                </a>
            </li>
        @endif
        @foreach ($menuitems as $item) 
            @if(!$item->permi || $item->permi == auth()->user()->role)  
                @if($item->type == 'dynamic' ? Route::has($item->val) : true)      
                    <li>
                        <a href="{{$item->type == "dynamic" ? route($item->val) : $item->val}}">
                            <i class="{{$item->icon}}"></i> <span>{{$item->name}}</span>
                        </a>
                    </li>
                @else
                <li>
                    <a class="text-warning">
                        <i class="{{$item->icon}}"></i> <span>{{$item->name}} <b>( Route Not Founded )</b></span>
                    </a>
                </li>
                @endif
            @endif
        @endforeach
    </ul>
    </section>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 926px;">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.0
        </div>
        <strong>Copyright © 2020-{{date('Y')}} <a href="{{route('heroadm.dashboard')}}">LittleADM</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a
                    href="#control-sidebar-theme-demo-options-tab"
                    data-toggle="tab"><i class="fas fa-wrench"></i></a></li>
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i
                        class="fas fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab"
                    data-toggle="tab"><i class="fas fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
                    <div>
                        <h4 class="control-sidebar-heading">Layout Options</h4>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-layout="fixed" class="pull-right"> Fixed layout</label>
                            <p>Activate the fixed layout. You can't use fixed and boxed layouts together</p>
                        </div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-layout="layout-boxed" class="pull-right"> Boxed Layout</label>
                            <p>Activate the boxed layout</p>
                        </div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-layout="sidebar-collapse" class="pull-right"> Toggle Sidebar</label>
                            <p>Toggle the left sidebar's state (open or collapse)</p>
                        </div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-enable="expandOnHover" class="pull-right"> Sidebar Expand on Hover</label>
                            <p>Let the sidebar mini expand on hover</p>
                        </div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-controlsidebar="control-sidebar-open" class="pull-right"> Toggle Right Sidebar
                                Slide</label>
                            <p>Toggle between slide over content and push content effects</p>
                        </div>
                        <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                    data-sidebarskin="toggle" class="pull-right"> Toggle Right Sidebar Skin</label>
                            <p>Toggle between dark and light skins for the right sidebar</p>
                        </div>
                        <h4 class="control-sidebar-heading">Skins</h4>
                        <ul class="list-unstyled clearfix">
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span
                                            class="bg-light-blue"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Blue</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-black" id="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span
                                            style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span
                                            style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                                    </div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Black</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-purple" id="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-purple-active"></span><span class="bg-purple"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Purple</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-green" id="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-green-active"></span><span class="bg-green"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Green</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-red" id="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-red-active"></span><span class="bg-red"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Red</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-yellow" id="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-yellow-active"></span><span class="bg-yellow"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin">Yellow</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-blue-light" id="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span
                                            class="bg-light-blue"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Blue Light</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-black-light" id="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span
                                            style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span
                                            style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                                    </div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Black Light</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-purple-light"
                                    style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    id="skin-purple-light" 
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-purple-active"></span><span class="bg-purple"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Purple Light</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-green-light" id="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-green-active"></span><span class="bg-green"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Green Light</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-red-light" id="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-red-active"></span><span class="bg-red"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Red Light</p>
                            </li>
                            <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)"
                                    data-skin="skin-yellow-light"
                                    style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)"
                                    id="skin-yellow-light"
                                    class="clearfix full-opacity-hover">
                                    <div><span style="display:block; width: 20%; float: left; height: 7px;"
                                            class="bg-yellow-active"></span><span class="bg-yellow"
                                            style="display:block; width: 80%; float: left; height: 7px;"></span></div>
                                    <div><span
                                            style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span
                                            style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                                    </div>
                                </a>
                                <p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <script src=" {{ asset('dashboard/js/jquery.min.js')}}"></script>
    <script src=" {{ asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src=" {{ asset('dashboard/js/fastclick.js')}}"></script>
    <script src=" {{ asset('dashboard/js/adminlte.min.js')}}"></script>
    <script src=" {{ asset('dashboard/js/jquery.sparkline.min.js')}}"></script>
    <script src=" {{ asset('dashboard/js/jquery-jvectormap-1.2.2.min.js')}}"></script>


    <script src=" {{ asset('dashboard/js/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src=" {{ asset('dashboard/js/jquery.slimscroll.min.js')}}"></script>
    <script src=" {{ asset('dashboard/js/Chart.js')}}"></script>

    <script src=" {{ asset('dashboard/js/dashboard2.js')}}"></script>
    <script src=" {{ asset('dashboard/js/demo.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>




    <div class="jvectormap-label"></div>

    <script>
        document.onload = function(){
            @if(env('LITTLEADM_DASHBOARD_SKIN', "customize") != "customize")
                if($("#skin-" + '{{ env('LITTLEADM_DASHBOARD_SKIN', "red-light") }}')){
                    $("#skin-" + '{{ env('LITTLEADM_DASHBOARD_SKIN', "red-light") }}').click();
                }else{
                    alert("The Skin '" + '{{ env('LITTLEADM_DASHBOARD_SKIN', "red-light") }}' + "' is not founded!");
                }
            @endif
        };
    </script>
</body>

</html>