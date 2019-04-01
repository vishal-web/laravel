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
					$name = old('name') == '' ? (isset($post['name']) ? $post['name'] : '') : old('name');
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
					
					<div class="form-group">
						<input type="submit" name="submit" value="@if ($update_id > 0) Update @else Submit @endif" class="btn btn-primary">
						<a href="/post"><input type="button" name="submit" value="Cancel" class="btn btn-danger"></a>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection