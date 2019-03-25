<style type="text/css">
	.navbar-right { margin-right: 0px; }
</style>
<nav class="navbar navbar-static-top navbar-default" role="navigation">
	<div class="container1"> 
 

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="@if (Request::segment('1') == 'dashboard') active @endif"><a href="/dashboard">Dashboard</a></li>
				<li class="@if (Request::segment('1') == 'order') active @endif"><a href="/order">Order</a></li>
				<li class="@if (Request::segment('1') == 'create-order') active @endif"><a href="/create-order">Create Order</a></li>
			</ul>
		
			 <ul class="nav navbar-nav navbar-right">
				<li class="@if (Request::segment('1') == 'logout') active @endif"><a href="/dashboard">Logout</a></li> 
			</ul>
		
			 
		</div><!-- /.navbar-collapse -->
	</div>
</nav>