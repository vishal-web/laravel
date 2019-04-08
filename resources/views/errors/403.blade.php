@extends('layouts.app')

@section('content')
<center style="margin-top: 10%">
	<p>{{ $exception->getMessage() }}</p>
	<a href="/">Go Back</a>
</center>
@endsection