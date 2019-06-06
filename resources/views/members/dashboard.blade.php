@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h3 class="mb-16">Courses</h3>
				
				<div class="gray-box">
					@if(count($courses) > 0)
						<div class="row">
							@foreach($courses as $course)
							<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
								<a href="/members/courses/{{ $course->id }}/dashboard" class="blog-link">
									<div class="image-box-edge">
										<div class="image-box-image set-bg" data-setbg="{{ $course->image_url }}"></div>
										<div class="image-box-info">
											<h5 class="text-center">{{ $course->title }}</h5>
										</div>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					@else
						<h4 class="text-center mb-8">No Courses</h4>
						<p class="text-center mb-0">There are currently no courses available. We are still working on creating the best quality course for you and we will email you once it's done!</p>
					@endif
				</div>

				@if($session_stats["average_cycles"] != 0 || $session_stats["average_seconds"] != 0)
				<h3 class="mb-16 mt-32">Pomodoro Tool</h3>
				<div class="gray-box">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<h2 class="text-center">{{ sprintf("%.2f", $session_stats["average_cycles"]) }}</h2>
							<h6 class="text-center">Average Pomodoro Cycles</h6>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
							<h2 class="text-center">{{ gmdate("H:i:s", $session_stats["average_seconds"]) }}</h2>
							<h6 class="text-center">Average Session Time</h6>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
							<a href="{{ url('/members/pomodoro/session') }}" class="primary genric-btn rounded mt-8 centered">New Session</a>
						</div>
					</div>
				</div>
				@else
				<h3 class="mb-16 mt-32">Pomodoro Tool</h3>
				<div class="gray-box">
					<div class="row">
						<div class="col-12">
							<h4 class="mb-2 text-center">No Sessions Found</h4>
							<p class="text-center">Start your first Pomodoro session! Click below!</p>
							<a href="{{ url('/members/pomodoro/session') }}" class="primary genric-btn rounded mt-8 centered">New Session</a>
						</div>
					</div>
				</div>
				@endif

				@if($is_enrolled == true)
					<h3 class="mt-32 mb-16">Personal Coaching</h3>

					<?php $recommendations = \App\Custom\MentorHelper::getRecommendationsForUser(Auth::id()); ?>
					@if(count($recommendations) > 0)
						<div class="gray-box">
							<h5 class="mb-16">Recommendations</h5>

							<ul class="list-group">
								@foreach($recommendations as $recommendation)
								<li class="list-group-item">
									<div class="row">
										<div class="col-12">
											<h4 class="mb-2">{{ $recommendation->title }}</h4>
											<a href="{{ $recommendation->link }}" target="_blank" class="genric-btn primary rounded small">Visit Link</a>
										</div>
									</div>

									<div class="row mt-16">
										<div class="col-12">
											<p class="mb-0">{{ $recommendation->description }}</p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					@endif

					<?php $videos = \App\Custom\MentorHelper::getVideosForUser(Auth::id()); ?>
					@if(count($videos) > 0)
						<div class="gray-box mt-32">
							<h5 class="mb-16">Videos</h5>

							<ul class="list-group">
								@foreach($videos as $video)
								<li class="list-group-item">
									<div class="row">
										<div class="col-12">
											<h4 class="mb-2">{{ $video->title }}</h4>
											<a href="https://www.youtube.com/watch?v={{ $video->video_id }}" target="_blank" class="genric-btn primary rounded small">Watch Video</a>
										</div>
									</div>

									<div class="row mt-16">
										<div class="col-12">
											<p class="mb-0">{{ $video->description }}</p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					@endif

					<?php $documents = \App\Custom\MentorHelper::getDocumentsForUser(Auth::id()); ?>
					@if(count($documents) > 0)
						<div class="gray-box mt-32">
							<h5 class="mb-16">Documents</h5>

							<ul class="list-group">
								@foreach($documents as $document)
								<li class="list-group-item">
									<div class="row">
										<div class="col-12">
											<h4 class="mb-2">{{ $document->title }}</h4>
											<a href="{{ $document->link }}" target="_blank" class="genric-btn primary rounded small">Access Document</a>
										</div>
									</div>

									<div class="row mt-16">
										<div class="col-12">
											<p class="mb-0">{{ $document->description }}</p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					@endif

					<?php $documents = \App\Custom\MentorHelper::getTasksForUser(Auth::id()); ?>
					@if(count($documents) > 0)
						<div class="gray-box mt-32">
							<h5 class="mb-16">Tasks</h5>

							<ul class="list-group">
								@foreach($tasks as $task)
								<li class="list-group-item">
									<div class="row">
										<div class="col-12">
											<h4>{{ $task->title }}</h6>
										</div>
									</div>

									<div class="row mt-16">
										<div class="col-12">
											<p class="mb-0">{{ $task->description }}</p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					@endif
				@endif
			</div>

			{{-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="gray-box">
					<h5 class="text-center mb-2">Quick Actions</h5>
					<p class="mb-0 text-center">TODO: Create a helper class to dynamically build quick actions.</p>
				</div>
			</div> --}}
		</div>
	</div>

	@if($is_enrolled == false)
	<div style="background: #EAEAEA;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center mb-8">Self-Mastery Quiz</h2>
					<p class="text-center">Take our free quiz to score yourself on how well you've mastered the self. If there are any weak areas, we can help you start mastering the self.</p>
					<a href="{{ url('/self-dev-quiz') }}" class="genric-btn primary rounded centered" style="font-size: 15px;">Take Self-Mastery Quiz</a>
				</div>
			</div>
		</div>
	</div>
	@endif
@endsection