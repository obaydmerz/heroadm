{{-- <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{$title}}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('heroadm.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            @foreach ($crumb as $crm)
                <li class="breadcrumb-item"><a href="{{route($crm['route'])}}">{{$crm['title']}}</a></li>
            @endforeach
        </ol>
    </div><!-- /.col -->
</div> --}}
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{{$title}}</h4><span
				class="text-muted mt-1 tx-13 mr-2 mb-0">@foreach ($crumb as $crm)/ <a href="{{route($crm['route'])}}"> {{$crm['title']}}  </a>@endforeach</span>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">

	</div>
</div>