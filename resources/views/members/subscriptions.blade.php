@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h3 class="mb-4">Courses</h3>
				@if(count($subscriptions["courses"]) > 0)
					@foreach($subscriptions["courses"] as $course)
						<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-8 mb-8">
							<div class="gray-box">

								<h3 class="text-center mb-0">{{ \App\Custom\CourseHelper::getTitle($course->course_id) }}</h3>
								<p class="text-center mb-2"><small>Enrolled on {{ $course->created_at->format('M jS, Y') }}</small></p>

								@if($course->customer_id == null)
									<h5 class="text-center mb-2">Price: <span class="green">Free</span></h5>
								@endif

								@if($course->next_payment_date == null)
									<h5 class="text-center mb-0">Next Payment Date: N/A</h5>
								@else
									<h5 class="text-center mb-0">Next Payment Date: {{ Carbon\Carbon::parse($course->next_payment_date)->format('M jS, Y') }}</h5>
								@endif
							</div>
						</div>
					@endforeach
				@else
				<div class="gray-box">
					<h5 class="text-center">Not Enrolled in Any Course</h5>
				</div>
				@endif

				<h3 class="mt-5 mb-4">Personal Coaching</h3>
				@if($subscriptions["mentor"] != null)
					<div class="gray-box">
						<h4 class="text-center mb-2 text-dark">Enrolled on {{ $subscriptions["mentor"]->created_at->format('M jS, Y') }}</h4>
						<p class="text-center">Next Payment Date: {{ Carbon\Carbon::parse($subscriptions["mentor"]->next_payment_date)->format('M jS, Y') }}</p>

						{{ $subscriptions["mentor"] }}
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection