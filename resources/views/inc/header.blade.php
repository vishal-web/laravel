<!DOCTYPE html>
<html>
  <head> 
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  	<script src="//code.jquery.com/jquery.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <title>{{config('app.name','Laravel First Application')}}</title>
  </head>
  <body>
  	<nav class="navbar navbar-inverse navbar-fixed-top">
  	  <div class="container">
  	    <div class="navbar-header">
  	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  	      <span class="sr-only">Toggle navigation</span>
  	      <span class="icon-bar"></span>
  	      <span class="icon-bar"></span>
  	      <span class="icon-bar"></span>
  	      </button>
  	      <a class="navbar-brand" href="#">Project name</a>
  	    </div>
 
        <div class="nav navbar-nav">
          <li class="active">
            <a href="#">Home</a>
          </li>
          <li>
            <a href="#">Link</a>
          </li>
        </div>

  	    <div id="navbar" class="navbar-collapse collapse">
  	      <form class="navbar-form navbar-right">
  	        <div class="form-group">
  	          <input type="text" placeholder="Email" class="form-control">
  	        </div>
  	        <div class="form-group">
  	          <input type="password" placeholder="Password" class="form-control">
  	        </div>
  	        <button type="submit" class="btn btn-success">Sign in</button>
  	      </form>
  	    </div>
  	    <!--/.navbar-collapse -->
  	  </div>
  	</nav>