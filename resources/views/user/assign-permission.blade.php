@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Roles
				</h3>
			</div>
			<div class="panel-body">

				<p>Assign Role to - <b>{{ $username }}</b></p>

				@if (Session::get('error_role'))
					<div class="alert alert-danger">
						<p>{{ Session::get('error_role') }}</p>
					</div>
				@endif

				@if (Session::get('success_role'))
					<div class="alert alert-success">
						<p>{{ Session::get('success_role') }}</p>
					</div>
				@endif

				@if (!empty($roles))

					@if ($errors->has('role')) 
						<p class="text-danger">{{ $errors->first('role') }}</p>
					@endif

					<form method="POST" action="{{ $form_location }}">
						{{ csrf_field() }}
						<ul class="list-unstyled">
						@foreach($roles as $role)
							<li>	
								<div class="checkbox-inline">
									<label class="">
										<input type="checkbox" class="checkbox" name="role[]" value="{{ $role->id }}">
										&nbsp;{{ $role->name }}
									</label>
								</div> 

							</li> 
						@endforeach
						</ul>
						<div class="form-group">
							<input type="submit" value="Assign Roles" name="submit" class="btn btn-primary">
						</div>
					</form>
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Permissions
				</h3>
			</div>
			<div class="panel-body">

				<p>Assign Permission to - <b>{{ $username }}</b></p>

				@if (Session::get('error_permission'))
					<div class="alert alert-danger">
						<p>{{ Session::get('error_permission') }}</p>
					</div>
				@endif

				@if (Session::get('success_permission'))
					<div class="alert alert-success">
						<p>{{ Session::get('success_permission') }}</p>
					</div>
				@endif

				@if (!empty($permissions))

					@if ($errors->has('permission')) 
						<p class="text-danger">{{ $errors->first('permission') }}</p>
					@endif

					<form method="POST" action="{{ $form_location }}">
						{{ csrf_field() }}
						<ul class="list-unstyled">
						@foreach($permissions as $permission)
							<li>	
								<div class="checkbox-inline">
									<label class="">
										<input type="checkbox" class="checkbox" name="permission[]" value="{{ $permission->id }}">
										&nbsp;{{ $permission->name }}
									</label>
								</div> 
									{{-- 
										<a href="/permission/{{ $permission->id }}/edit">Edit</a>
										<a href="/permission/{{ $permission->id }}/delete">Delete</a> 
									--}} 
							</li> 
						@endforeach
						</ul>
						<div class="form-group">
							<input type="submit" value="Assign Permissions" name="submit" class="btn btn-primary">
						</div>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection