@extends('layout.app')

@section('content')
<div class="content-wrapper" style="margin-top: 60px;">
	<div class="container"> 
		<div class="col-md-4 panel panel-default col-md-offset-4" style="margin-top: 40px;">
 			<h3 class="text-center">LogIn</h3>
		{{-- 	@if ($errors->any())
				<div class="alert alert-danger" style="margin-top: 20px;">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif --}}

			@if (Session::get('authErr')) 
				<div class="alert alert-danger">
					<p>{{Session::get('authErr')}}</p>
				</div>
			@endif

			<form action="/login" class="panel-body" method="POST" role="form">

			 	{{ csrf_field() }}
			 	
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
 
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection