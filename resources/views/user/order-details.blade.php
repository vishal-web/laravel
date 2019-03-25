@extends('user.userlayout')

@section('content')
<div class="container">
	<div class="row col-md-6">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Customer Name</th>
				<td>{{ $order_detail['firstname'].' '.$order_detail['lastname'] }}</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>{{ $order_detail['email'] }}</td>
			</tr>
			<tr>
				<th>Contact</th>
				<td>{{ $order_detail['contact'] }}</td>
			</tr>
			<tr>
				<th>Landmark</th>
				<td>{{ $order_detail['shipping_landmark'] }}</td>
			</tr>
			<tr>
				<th>Shipping Details</th>
				<td>{{ $order_detail['shipping_address1'] .' '. $order_detail['shipping_address2'] .', '. $order_detail['shipping_city'] .', '.$order_detail['shipping_state'] }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection