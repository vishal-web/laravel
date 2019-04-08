@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Manage Users	
					@can('userCreate')
					<div class="pull-right">
						<a href="/user/create">Create User</a>
					</div>
					@endcan
				</h3>
			</div>
			<div class="panel-body">
				@if (!empty($users))
					@php
						$i = 0;
					@endphp

					<table class="table table-bordered table-striped">

						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>

					@foreach($users as $user)
						<tr>	
							<td>{{ ++$i }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td> 
							<td>
								@can('userRole')
								<a href="/user/{{ $user->id }}/role">Assign Role</a> 
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