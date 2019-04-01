@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-9 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> 
					@if ($update_id > 0) Edit Permission @else Create Permission @endif 
				</h3>
			</div>

			<div class="panel-body">
				@php
					$name = old('name') == '' ? (isset($permission['name']) ? $permission['name'] : '') : old('name');
					$permission_val = old('permission') == '' ? (isset($permission_permissions) ? $permission_permissions : array()) : old('permission');
				@endphp 

				{{-- @if (!empty($errors))
					@foreach($errors->all() as $error)
						{{ $error }}
					@endforeach
				@endif --}}

				@if (Session::get('success'))
					<div class="alert alert-success">
						<p class="">{{ Session::get('success') }}</p>
					</div>					
				@endif

				@if (Session::get('error'))
					<div class="alert alert-danger">
						<p class="">{{ Session::get('error') }}</p>
					</div>
				@endif

				<form action="{{ $form_location }}" method="POST">
					
					{{ csrf_field() }}

					<div class="form-group @if ($errors->has('name')) has-error @endif">
						<label for="name">Permission</label>
						<input type="text" name="name" class="form-control" value="{{ $name }}" placeholder="Permission name">
						@if ($errors->has('name')) <p class="text-danger"> {{ $errors->first('name') }} </p> @endif
					</div>					
					

					@if (!empty($permissions))
					<div class="form-group  @if ($errors->has('permission')) has-error @endif">
						<label for="name">Permissions</label>
						<br>
						@foreach($permissions as $permission)
							<div class="checkbox-inline">
								@php
									$checked = in_array($permission->id, $permission_val) ? " checked" : '';
								@endphp
								<label>
									<input type="checkbox" name="permission[]"  value="{{ $permission->id }}" {{ $checked }}>
									{{ $permission->name }}
								</label> 
							</div>
						@endforeach
						@if ($errors->has('permission')) <p class="text-danger"> {{ $errors->first('permission') }} </p> @endif
					</div>	
					@endif

					<div class="form-group">
						<input type="submit" name="submit" value="@if ($update_id > 0) Update @else Submit @endif" class="btn btn-primary">
						<a href="/permissions/show"><input type="button" name="submit" value="Cancel" class="btn btn-danger"></a>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection