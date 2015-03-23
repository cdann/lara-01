<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">



	<link rel="shortcut icon" href="/images/gt_favicon.png">

	<!-- Bootstrap itself -->
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Custom styles -->
	<link rel="stylesheet" href="/css/magister.css">

	<!-- Fonts -->
	<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
	<title>@yield('title', 'Great Celine Framework 0')</title>
</head>

<!-- use "theme-invert" class on bright backgrounds, also try "text-shadows" class -->
<body class="theme-invert">

<nav class="mainmenu">
	<div class="container">
		<div class="dropdown">
			<button type="button" class="navbar-toggle" data-toggle="dropdown"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<!-- <a data-toggle="dropdown" href="#">Dropdown trigger</a> -->
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				@if (Auth::guest())
						<li><a  href="/" class="active">Hello</a></li>
						<li><a href="/user/login">Login</a></li>
						<li><a href="/user/register">Register</a></li>
					@else
						<li><a  href="/" class="active">Hello {{ Auth::user()->name }}</a></li>
						@if(Session::has('Admin'))
							<li><a href="/user">Panel Admin</a></li>
							@else
							<li><a href="/user/edit/{{Auth::user()->id}}">Modifier mon profil</a></li>
						@endif
						<li><a  href="/contact">Contact Us</a></li>

						<li><a href="/user/logout" >Logout</a></li>
					@endif
			</ul>
		</div>
	</div>
</nav>

@if (Session::has('success'))
	<div class="alert alert-success">
		{{(Session::get('success'))}}
	</div>
@endif

	</div>
@if (Session::has('test'))
	<div class="alert alert-warning">
		{{Session::get('test')}}
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif
@foreach ($errors->all() as $error)
	<div class="alert alert-danger">
  		{{ $error }}
  	</div>
@endforeach

<!-- Main (Home) section -->
<section class="section" id="head">
	<div class="container">

		<h2 class="text-center title">@yield('title')</h2>
		<div class="row">
			<div class="col-sm-12">
				@yield('content')
			</div>
		</div>
	</div>
</section>



<!-- Load js libs only when the page is loaded. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<!--  script src="js/modernizr.custom.72241.js"></script -->
<!-- Custom template scripts -->
<!-- script src="js/magister.js"></script -->
</body>
</html>
