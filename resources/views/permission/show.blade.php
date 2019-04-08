@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Permissions 
					@can('permissionCreate')
					<div class="pull-right">
						<p><a href="/permissions/create">Create Permission</a></p>
					</div>
					@endcan
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



				@if (!empty($permissions))
					<table class="table table-bordered table-striped">
						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					
					@php
						$i = 0;
					@endphp

					@foreach($permissions as $permission)
						<tr>	
							<td>{{ ++$i }}</td>
							<td>{{ $permission->name }}</td>
							<td class="col-md-3"> 

								@can('permissionEdit')
								<a class='btn btn-primary btn-xs' href="/permissions/{{ $permission->id }}/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								@endcan
								@can('permissionDestroy')
								<a class='btn btn-danger btn-xs' href="/permissions/{{ $permission->id }}/destroy"><i class="glyphicon glyphicon-trash"></i> Delete</a>  
								@endcan
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