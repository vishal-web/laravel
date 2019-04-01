@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Roles 
					<div class="pull-right">
						<p><a href="/roles/create">Create Role</a></p>
					</div>
				</h3>
			</div>
			<div class="panel-body">

				@if (Session::get('error'))
					<div class="alert alert-danger">
						<p>{{ Session::get('error') }}</p>
					</div>
				@endif

				

				@if (Session::get('success'))
					<div class="alert alert-success">
						<p>{{ Session::get('success') }}</p>
					</div>
				@endif



				@if (!empty($roles))
					<table class="table table-bordered table-striped">
						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					
					@php
						$i = 0;
					@endphp

					@foreach($roles as $role)
						<tr>	
							<td>{{ ++$i }}</td>
							<td>{{ $role->name }}</td>
							<td class="col-md-3"> 
								<a class='btn btn-primary btn-xs' href="/roles/{{ $role->id }}/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<a class='btn btn-danger btn-xs' href="/roles/{{ $role->id }}/delete"><i class="glyphicon glyphicon-trash"></i> Delete</a>  
							</td>
								 
						</tr> 
					@endforeach
					</table> 
				@endif
			</div>
		</div>
	</div>
</div>
@endsection