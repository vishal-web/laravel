@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Roles Permission
					<div class="pull-right">
						<p><a href="/permission/create">Create New Permission</a></p>
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

				@if (!empty($permissions))

					@if ($errors->has('permission')) 
						<p class="text-danger">{{ $errors->first('permission') }}</p>
					@endif


					<form method="POST" action="/role-management">
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