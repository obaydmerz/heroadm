<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Author" content="InterPlare Company, By Abderrahmene Merzoug">

		@include('layouts.head')
	</head>
	
	<body class="main-body bg-primary-transparent">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include("heroadm::includes.sweet")
		@yield('content')		
		@include('heroadm::layouts.footer-scripts')	
	</body>
</html>