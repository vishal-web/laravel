@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Posts	
					@can('write-post')
					<div class="pull-right">
						<a href="/post/create">Create Posts</a>
					</div>
					@endcan
				</h3>
			</div>
			<div class="panel-body">
				@if (!empty($posts))
					<ul class="list-unstyled1">
					@foreach($posts as $post)
						<li style="margin:7px 0;">	
							<a href="/post/{{ $post->id }}/edit">{{ $post->title }}</a>
							<div class="pull-right">
								@can('edit-post')
								<a href="/post/{{ $post->id }}/edit">Edit</a>
								@endcan
								{{-- <a href="/post/{{ $post->id }}/delete">Delete</a> --}}
								@can('publish-post')
								<a href="/post/{{ $post->id }}/publish">Publish</a>
								@endcan
							</div>
						</li> 
					@endforeach

					{{ $posts->links() }}
					</ul>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection