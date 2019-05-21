@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				<ul class="list-group">
					@foreach ($posts as $post)
					<li class="list-group-item p-32 blog-entry">
						<a class="blog-link" href="/post/{{ $post->id }}/{{ $post->slug }}">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<img class="regular-image rounded-image" src="{{ $post->featured_image_url }}">
								</div>
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<h4>{{ $post->title }}</h4>
									<p class="mb-2"><small>Created on {{ $post->created_at->format('M d Y') }}</small></p>
									<p>{{ strip_tags(substr($post->body, 0, 256)) }}</p>
								</div>
							</div>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				{{ $posts->links() }}
			</div>
		</div>
	</div>
@endsection