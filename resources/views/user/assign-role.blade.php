@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
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
							@php
								$checked = in_array($role->id, $assigned_roles) ? 'checked' : '';
							@endphp

							<li>	
								<div class="checkbox-inline">
									<label class="">
										<input type="checkbox" class="checkbox" name="role[]"  value="{{ $role->id }}" {{ $checked }} >
										&nbsp;{{ $role->name }}
									</label>
								</div> 

							</li> 
						@endforeach
						</ul>
						<div class="form-group">
							<input type="submit" value="Assign Roles" name="submit" class="btn btn-primary">
							<a href="/user/manage-users"><input type="button" value="Cancel" name="submit" class="btn btn-danger"></a>
						</div>
					</form>
				@endif
			</div>
		</div>
	</div>
 </div>
@endsection