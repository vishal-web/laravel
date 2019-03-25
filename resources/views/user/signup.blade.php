@extends('layout.app')

@section('content')
<div class="content-wrapper" style="margin-top: 60px;">
	<div class="container"> 
		<div class="col-md-4 panel panel-default col-md-offset-4" style="margin-top: 40px;">
 		
		<h3 class="text-center">SignUp</h3>

		{{-- @if ($errors->any())
			<div class="alert alert-danger" style="margin-top: 20px;">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif --}}

		{{ Session::get('flash-message') }}


			<form action="/signup" class="panel-body" method="POST" role="form">

			 	{{ csrf_field() }}
			 	
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" class="form-control" id="" name="name" value="{{ old('name') }}" placeholder="Enter your name">
					@if ($errors->has('name')) <p class='text-danger'>{{ ucfirst(str_replace('The ', '', $errors->first('name'))) }}</p> @endif
				</div>

				<div class="form-group">
					<label for="">Email</label>
					<input type="text" class="form-control" id="" name="email" value="{{ old('email') }}" placeholder="Enter your email">
					@if ($errors->has('email')) <p class='text-danger'>{{ ucfirst(str_replace('The ', '', $errors->first('email'))) }}</p> @endif
				</div>

				
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" class="form-control" id="" name="password" value="{{ old('password') }}" placeholder="Enter your password">
					@if ($errors->has('password')) <p class="text-danger"> {{ ucfirst(str_replace('The ', '', $errors->first('password'))) }} </p> @endif
				</div>
				
				<div class="form-group">
					<label for="">Mobile No</label>
					<input type="text" class="form-control" id="" name="mobile" value="{{ old('mobile') }}" placeholder="Enter your mobile">
					@if ($errors->has('mobile')) <p class="text-danger"> {{ ucfirst(str_replace('The ', '', $errors->first('mobile'))) }} </p> @endif
				</div>
 				
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection