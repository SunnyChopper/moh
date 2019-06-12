@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<ul class="list-group">
					@foreach($videos as $video)
						<li class="list-group-item">
							<div class="row" style="display: flex;">
								<div class="col-6">
									<h4 class="mb-2">{{ $video->title }}</h4>
									<p class="mb-2">{{ substr($video->description, 0, 128) }}...</p>
								</div>
								<div class="col-6" style="margin: auto;">
									<a href="{{ url('/members/courses/' . $course->id . '/module/' . $module->id . '/watch/' . $video->id) }}" class="genric-btn info rounded small" style="float: right;">View Video</a>
								</div>
							</div>
						</li>
					@endforeach
				</ul>

				<a href="{{ url('/members/courses/' . $course->id . '/dashboard') }}" class="genric-btn primary rounded centered mt-32" style="font-size: 14px;">Back to Course Dashboard</a>
			</div>
		</div>
	</div>
@endsection