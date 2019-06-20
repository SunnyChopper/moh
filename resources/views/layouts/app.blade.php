<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="{{ URL::asset('img/fav.png') }}">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">

		<!-- Site Title -->
		@if(isset($page_title))
		<title>{{ config('app.name') }} - {{ $page_title }}</title>
		@else
		<title>{{ config('app.name') }}</title>
		@endif

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		<link rel="stylesheet" href="{{ URL::asset('css/linearicons.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/nice-select.css') }}">							
		<link rel="stylesheet" href="{{ URL::asset('css/animate.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.css') }}">			
		<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">			
		<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/layouts.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131372255-4"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-131372255-4');
		</script>

	</head>
	<body>
		<?php

			// Check to see if session variable needs to be set
			if (Illuminate\Support\Facades\Session::has('source')) {
				echo "<p id='source'>" . Illuminate\Support\Facades\Session::get('source') . "</p>";
			}

		?>
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
		@include('layouts.js')
	</body>
</html>