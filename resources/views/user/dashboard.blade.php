@extends('user.userlayout')

@section('content')
	<div class="container" style="margin-top: 100px;">
		<div class="col-md-6 col-md-offset-3">

			{{-- @if (!empty($errors->all()))
				<div class="alert alert-danger"> 
					@foreach($errors->all() as $err)
						<p>{{ $err }}</p>	
					@endforeach 
				</div>
			@endif --}}


			@if (Session::has('success')) 
			<div class="alert alert-success">
				<p class="">{{ Session::get('success') }}</p>  
			</div>
			@endif

			@if (Session::has('error')) 
			<div class="alert alert-danger">
				<p class="">{{ Session::get('error') }}</p>  
			</div>
			@endif

			<form  method="post" action="/fileupload" enctype="multipart/form-data">

				{{ csrf_field() }}

				<div class="form-group">
					<input type="file" name="file" class="form-control">

					@if ($errors->has('file')) <p class="text-danger">{{ $errors->first('file') }} </p> @endif

				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="submit">
				</div>
			</form>
		</div>

		<table class="table table-bordered">
			<tr>
				<th>Image</th>
				<th>Action</th>
			</tr>

			@if (!empty($images))
				@foreach($images as $image)

				<tr>
					<td><img height="50" width="50" src="{{ '/uploads/'.$image['filename'] }}"></td>
					<td><a href="/delete-image/{{$image['id']}}"><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"> </i> </button></a></td>
				</tr>

				@endforeach
			@endif

		</table>
	</div>			
@endsection
