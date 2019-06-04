@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($sessions) > 0)
			@else
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<div class="gray-box">
						<h3 class="text-center mb-8">No Previous Sessions</h3>
						<p class="text-center">We couldn't find any previous Pomodoro sessions for you. Click below to get started on your first Pomodoro session.</p>
						<a href="{{ url('/members/pomodoro/session') }}" class="genric-btn primary centered rounded" style="font-size: 15px;">Get Started</a>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection