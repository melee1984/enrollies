<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>window.laravel = { csrfToken: '{{ csrf_token() }}'}</script>

<head>
 	@include('includes.header')

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>

	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	  <a class="navbar-brand" href="#">Boostrap</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarCollapse">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="{{ URL::to('/') }}">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <!-- <li class="nav-item">
	        <a class="nav-link" href="{{ URL::to('/school') }}">School</a>
	      </li> -->
	    </ul>
	   
	  </div>
	</nav>

	<div id="app">
		@yield('content')
	</div>

	<!-- More Javascript here --> 
 	@include('includes.footer')


</body>
</html>