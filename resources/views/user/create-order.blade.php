@extends('user.userlayout')


@section('content')
<div class="container">

	@if (Session::has('error')) <div class="alert alert-danger"><p>{{ Session::get('error') }}</p></div>@endif
	@if (Session::has('success')) <div class="alert alert-success"><p>{{ Session::get('success') }}</p></div>@endif

	<form class="form-horizontal" method="POST" action="/create-order">
			
		{{ csrf_field() }}

		<div class="form-group">
			<label for="" class="col-md-3 control-label">Firstname</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="firstname" value="{{old('firstname')}}" placeholder="Please enter your firstname"> 
				@if ($errors->has('firstname')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('firstname'))) }}</p> @endif

			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Lastname</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="lastname" value="{{old('lastname')}}" placeholder="Please enter your lastname">
				@if ($errors->has('lastname')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('lastname'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Email</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Please enter your email">
				@if ($errors->has('email')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('email'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Contact</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="contact" value="{{old('contact')}}" placeholder="Please enter your contact">
				@if ($errors->has('contact')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('contact'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">State</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="state" value="{{old('state')}}" placeholder="Please enter your state">
				@if ($errors->has('state')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('state'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">City</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="city" value="{{old('city')}}" placeholder="Please enter your city">
				@if ($errors->has('city')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('city'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Landmark</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="landmark" value="{{old('landmark')}}" placeholder="Please enter your landmark">
				@if ($errors->has('landmark')) <p class="text-danger">{{ ucfirst(str_replace('The ','',$errors->first('landmark'))) }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-md-3 control-label">Address Line 1</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="address-line1" value="{{old('address-line1')}}" placeholder="Please enter your address-line1">
				@if ($errors->has('address-line1')) <p class="text-danger">{{ $errors->first('address-line1') }}</p> @endif
			</div>
		</div>
		
		<div class="form-group">	
			<label for="" class="col-md-3 control-label"></label>
			<div class="col-md-6">
			
				<input type="submit" class="btn btn-primary" name="submit" value="Submit" > 
			</div>
		</div>
	</form>
</div>
@endsection