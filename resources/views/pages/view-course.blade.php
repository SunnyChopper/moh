@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				@if($course->youtube_id != "")
				<div class="videoWrapper">
				    <!-- Copy & Pasted from YouTube -->
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/{{ $course->youtube_id }}?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>
				@else
				<img src="{{ $course->image_url }}" class="regular-image-100">
				@endif

				<h3 class="mt-16">{{ $course->title }}</h3>
				<p>{{ $course->description }}</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="gray-box">
					<h5 class="text-center">Enroll in Course</h5>
					<hr />
					<div class="row">
						<div class="col-6">
							<h6>Total:</h6>
						</div>

						<div class="col-6">
							<p class="mb-0 black" style="float: right;">${{ sprintf("%.2f", $course->price) }}</p>
						</div>
					</div>
					<hr />

					@if(Auth::guest())
					<p class="black text-center">If you do not have an account with Mind of Habit, click the button below to get registered and enrolled at the same time.</p>
					<a href="{{ url('/register?redirect_action=/courses/' . $course->id . '/enroll') }}" class="genric-btn primary rounded centered mb-4">Register and Enroll</a>
					<p class="black text-center">If you already have an account, click the button below to login and enroll.</p>
					<a href="{{ url('/login?redirect_action=/courses/' . $course->id . '/enroll') }}" class="genric-btn info rounded centered mb-0">Login and Enroll</a>
					@else
					<a href="{{ url('/courses/' . $course->id . '/enroll') }}" class="genric-btn info rounded centered">Enroll in Course</a>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection