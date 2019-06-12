@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<div class="videoWrapper mb-32">
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>

				<h3>{{ $video->title }}</h3>
				<p>{{ $video->description }}</p>

				<a href="{{ url('/members/courses/' . $course->id . '/modules/' . $module->id) }}" class="genric-btn primary rounded centered" style="font-size: 14px;">Back to Module</a>
			</div>
		</div>
	</div>
@endsection