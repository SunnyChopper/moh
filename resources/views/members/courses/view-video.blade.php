@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<div class="videoWrapper mb-32">
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>

				<h3>{{ $video->title }}</h3>
				<p>{{ $video->description }}</p>

				<a href="{{ url('/members/courses/' . $course->id . '/dashboard') }}" class="genric-btn primary rounded centered mt-32" style="font-size: 14px;">Back to Course Dashboard</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center">Course Completion</h4>
					<div class="progress mt-16 mb-16" style="height: 40px;">
						<div class="progress-bar" role="progressbar" style="width: {{ \App\Custom\CourseHelper::getCourseCompletion($course->id, Auth::id()) * 100 }}%;" aria-valuenow="{{ \App\Custom\CourseHelper::getCourseCompletion($course->id, Auth::id()) * 100 }}" aria-valuemin="0" aria-valuemax="100"><span style="color: black;">{{ \App\Custom\CourseHelper::getCourseCompletion($course->id, Auth::id()) * 100 }}%</span></div>
					</div>

					<?php $next_video = \App\Custom\CourseHelper::getNextVideo($video->id); ?>
					<?php $prev_video = \App\Custom\CourseHelper::getPrevVideo($video->id); ?>

					@if(\App\Custom\CourseHelper::isVideoComplete(Auth::id(), $video->id) == false)
					<a href="{{ url('/members/courses/complete/' . $course->id . '/' . $video->id) }}" class="btn btn-success full-width centered">Mark Complete</a>
					@endif

					@if($next_video != null)
					<div class="mt-16">
						<h4 class="mb-3">Up Next</h4>
						<img src="https://img.youtube.com/vi/{{ $next_video->youtube_id }}/hqdefault.jpg" class="regular-image-100 centered">
						<h5 class="mt-2">{{ $next_video->title }}</h5>
					</div>
					@endif

					<div class="row mt-16">
						@if($prev_video != null && $next_video != null)
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<a href="{{ url('/members/courses/' . $course->id . '/module/' . $prev_video->module_id . '/watch/' . $prev_video->id) }}" class="btn btn-primary full-width centered">Prev Video</a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<a href="{{ url('/members/courses/' . $course->id . '/module/' . $next_video->module_id . '/watch/' . $next_video->id) }}" class="btn btn-primary full-width centered">Next Video</a>
						</div>
						@elseif($prev_video == null && $next_video != null)
						<div class="col-12">
							<a href="{{ url('/members/courses/' . $course->id . '/module/' . $next_video->module_id . '/watch/' . $next_video->id) }}" class="btn btn-primary full-width centered">Next Video</a>
						</div>
						@elseif($prev_video != null && $next_video == null)
						<div class="col-12">
							<a href="{{ url('/members/courses/' . $course->id . '/module/' . $prev_video->module_id . '/watch/' . $prev_video->id) }}" class="btn btn-primary full-width centered">Prev Video</a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection