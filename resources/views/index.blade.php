@extends('heroadm.layouts.app')

@section('content')
<section class="content-header">
  @include('heroadm.includes.crumb', [
  'crumb' => [],
  ])
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="container">
  <div class="row d-flex justify-content-center">
    @if(in_array(auth()->user()->role, explode('|', $configs->get('role_cont_users'))))
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$ucount}}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('heroadm.crud.users.index')}}" class="small-box-footer">Read <i
            class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endif
        @foreach ($menuitems as $item) 
        @if(!$item->permi || in_array(auth()->user()->role, explode('|', $item->permi)))  
            @if($item->type == 'crud' && Route::has('heroadm.crud.' . $item->val . '.index'))
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{$localetrt->isTrans($item->name) ? $localetrt->getTradCompressed($item->name, app()->getLocale()) : $item->name}}</h3>

                    <p>{{$localetrt->isTrans($item->name) ? $localetrt->getTradCompressed($item->name, app()->getLocale()) : $item->name}}</p>
                  </div>
                  <div class="icon">
                    <i class="{{$item->icon}}"></i>
                  </div>
                  <a href="{{route('heroadm.crud.' . $item->val . '.index')}}" class="small-box-footer">Read <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif
        @endif
    @endforeach
  </div>   
</div>

</section>
<!-- /.content -->
@endsection