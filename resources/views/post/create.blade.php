@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-md-9 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> 
					@if ($update_id > 0) Edit Post @else Create Post  @endif
				</h3>
			</div>

			<div class="panel-body">
				@php
					$title = old('title') == '' ? (isset($post['title']) ? $post['title'] : '') : old('title');
					$description = old('description') == '' ? (isset($post['body']) ? $post['body'] : '') : old('description') ;
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

					<div class="form-group @if ($errors->has('title')) has-error @endif">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control" value="{{ $title }}" placeholder="Post title">
						@if ($errors->has('title')) <p class="text-danger"> {{ $errors->first('title') }} </p> @endif
					</div>					
					
					<div class="form-group @if ($errors->has('description')) has-error @endif">
						<label for="description">Description</label>
						<textarea type="text" name="description" rows="10" class="form-control" placeholder="Post description">{{ $description }}</textarea>

						@if ($errors->has('description')) <p class="text-danger"> {{ $errors->first('description') }} </p> @endif
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