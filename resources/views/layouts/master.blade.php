<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Author" content="InterPlare Company, By Abderrahmene Merzoug">
		@include('heroadm::layouts.head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@include("heroadm::includes.crumb")
				@include("heroadm::includes.sweet")
				@yield('content')
				@include('heroadm::layouts.sidebar')
				@include('heroadm::layouts.models')
            	@include('heroadm::layouts.footer')
				@include('heroadm::layouts.footer-scripts')	
	</body>
</html>