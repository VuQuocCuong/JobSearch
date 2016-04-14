<!DOCTYPE html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="keywords" content="social job search" />
	<meta name="description" content="Web application for social it job search free" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<title>Social IT Job Search</title>
	<!-- Style Sheet -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/form.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/design.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/cv-style.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" />
	<!-- Javascript -->
	<script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
	<script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
	<script language="JavaScript" type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
	<div class="main-wrapper sub">
		<div id="loading"></div>
		<div id="messageBox"></div>
		<div id="header-bg">
			<div id="header-bg-in"></div>
		</div>
		<div class="main-div">
			@include('header')
			@include('search')

			<!-- Content -->
			@yield('content')
			@include('footer')
		</div>
		<!-- Footer -->
	</div>
</body>
</html>