<!DOCTYPE html>
<html>
<head>
 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<title>{{ $title }}</title>
	<style type="text/css">
		input[type="checkbox"], input[type="radio"] {
			margin: 0px;
		}
	</style>
</head>
<body>

	<div class="container" style="border:1px solid #e6d6d6; padding:0px;margin-bottom: 100px; min-height: 300px;">
	
	@include('user.dashboard-nav')

	@yield('content')

	</div>
</body>
</html>