@extends('user.userlayout')


@section('content')
<div class="container">
	<form action="/delete-order" method="POST">
		<div class="row"> 
			<div class=" col-md-12">
				<p>
					<button class="btn btn-primary">Create Order</button>
					<button class="btn btn-danger">Delete Order</button>
				</p> 
			</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<th><input type="checkbox" name="" id="all-checked" class="checkbox"></th>
				<th>S.No</th>
				<th>Customer Name</th>
				<th>Email Address</th>
				<th>Contact No</th>
				<th>Shipping Details</th>
				<th>Action</th>
			</thead>


			@if (!empty($orders)) 
				@php
					$i = 0;
				@endphp

				@foreach($orders as $order)

				@php
					$customer_name = $order['firstname'] .' '. $order['lastname'];
					$shipping_details = $order['shipping_address1'] .' '. $order['shipping_address2'] .', '. $order['shipping_city'] .', '.$order['shipping_state'];
				@endphp

				<tr>
					<td><input type="checkbox" name="order[{{$order['id']}}]" class="checkbox"></td>
					<td>{{ ++$i }}</td>
					<td>{{$customer_name}}</td>
					<td>{{$order['email']}}</td> 
					<td>{{$order['contact']}}</td> 
					<td>{{$shipping_details}}</td> 
					<td>
						<a href=""><button type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button></a>
						<a href=""><button type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></button></a>
						<a href="/view-order/{{$order['id']}}"><button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button></a>
					</td>
				</tr>
				@endforeach
			@endif 
		</table>
	</form>
</div>

<script type="text/javascript">
	
</script>
@endsection