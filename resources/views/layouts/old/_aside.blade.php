<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dashboard/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>{{env('APP_NAME', 'Laravel')}}</b> Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->getPicture() ? auth()->user()->getPicture() : asset('dashboard/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                @if(Route::has('heroadm.dashboard'))
                    <li class="nav-item  ">
                        <a href="{{route('heroadm.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                @lang('heroadm/site.dashboard')
                            </p>
                        </a>

                    </li>
                @endif
                @if(in_array(auth()->user()->role, explode('|', $configs->get('role_cont_users'))))
                    <li class="nav-item">
                        <a href="{{route('heroadm.crud.users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                @lang('heroadm/site.users')
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @endif
                @if(in_array(auth()->user()->role, explode('|', $configs->get('role_cont_configs'))))
                    <li class="nav-item">
                        <a href="{{route('heroadm.configs')}}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                @lang('heroadm/site.configs')
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>
                @endif
                @if(in_array(auth()->user()->role, explode('|', $configs->get('role_cont_medias'))))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                @lang('heroadm/site.media.string')
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Route::has('heroadm.media'))
                                <li class="nav-item">
                                    <a href="{{route('heroadm.media', ['path' => '/'])}}" class="nav-link"><i class="far fa-circle"></i>
                                        @lang('heroadm/site.media.browser')
                                    </a>
                                </li>
                            @endif
                            @if(Route::has('heroadm.media.upload'))
                                <li class="nav-item">
                                    <a href="{{route('heroadm.media.upload')}}" class="nav-link"><i class="far fa-circle"></i>
                                        @lang('heroadm/site.media.upload')
                                    </a>
                                </li>
                            @endif
                            @if(Route::has('heroadm.media.new'))
                                <li class="nav-item">
                                    <a href="{{route('heroadm.media.new')}}" class="nav-link"><i class="far fa-circle"></i>
                                        @lang('heroadm/site.media.new')
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Route::has('heroadm.crud.mbuilders.index') && (in_array(auth()->user()->role, explode('|', $configs->get('role_cont_mbulider')))))
                    <li class="nav-item">
                        <a href="{{route('heroadm.crud.mbuilders.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                @lang('heroadm/site.mbuilder')
                            </p>
                        </a>
                    </li>
                @endif
                @foreach ($menuitems as $item) 
                    @if(!$item->permi || in_array(auth()->user()->role, explode('|', $item->permi)))  
                        @if($item->type == 'crud' && Route::has('heroadm.crud.' . $item->val . '.index'))      
                            <li class="nav-item">
                                <a href="{{route('heroadm.crud.' . $item->val . '.index')}}" class="nav-link">
                                    <i class="nav-icon {{$item->icon}}"></i>
                                    <p>
                                        {{$localetrt->isTrans($item->name) ? $localetrt->getTradCompressed($item->name, app()->getLocale()) : $item->name}}
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
                @foreach ($menuitems as $item) 
                    @if(!$item->permi || in_array(auth()->user()->role, explode('|', $item->permi)))  
                        @if(($item->type == 'dynamic' || $item->type == 'url') && ($item->type == 'dynamic' ? Route::has($item->val) : true))      
                            <li class="nav-item">
                                <a href="{{$item->type == "dynamic" ? route($item->val) : $item->val}}" class="nav-link">
                                    <i class="nav-icon {{$item->icon}}"></i>
                                    <p>
                                        {{$localetrt->isTrans($item->name) ? $localetrt->getTradCompressed($item->name, app()->getLocale()) : $item->name}}
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
                {{--<li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('dashboard/pages/charts/chartjs.html') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inline</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/buttons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buttons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/sliders.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/modals.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modals & Alerts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/navbar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar & Tabs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/timeline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/ribbons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ribbons</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Forms
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editors</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
               {{--  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tables
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DataTables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/jsgrid.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>jsGrid</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>