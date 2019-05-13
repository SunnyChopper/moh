@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12 col-12">
				<h3 class="mb-16">Course Modules</h3>
				<ul class="list-group">
					@foreach($modules as $m)
					<li class="list-group-item">
						<div style="display: inline-block;">
							<h5>{{ $m->title }}</h5>
							<p class="mb-0">{{ $m->description }}</p>
						</div>
						<a href="{{ url('/members/courses/' . $course->id . '/modules/' . $m->id) }}" class="genric-btn rounded small primary" style="float: right; display: inline-block;">View Content</a>
					</li>
					@endforeach
				</ul>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h3 class="text-center mb-16">Quick Actions</h3>
					<a href="{{ url('/members/courses' . $course->id . '/forums/new') }}" class="genric-btn primary centered rounded">New Forum</a>
				</div>
			</div>
		</div>
	</div>

	<div style="background: #F0F0F0;">
		<div class="container pt-64 pb-64">
			<div class="row justify-content-center">
				@if(count($forums) > 0)
				<div class="col-12">
					<h3>Course Forums</h3>
					<hr />	
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th style="width: 75%;">Title</th>
									<th style="width: 15%;">Created At</th>
									<th style="width: 10%">Replies</th>
								</tr>
							</thead>

							<tbody>
								@foreach($forums as $f)
								<tr>
									<td style="width: 75%;">{{ $f->title }}</td>
									<td style="width: 15%;">{{ $f->created_at->format('H:i:s M jS, Y') }}</td>
									<td style="width: 10%">TODO</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						<div class="centered">
							<a href="{{ url('/members/courses/' . $course->id . '/forums') }}" class="genric-btn rounded centered info" style="display: inline-block;">View All Forums</a>
							<a href="{{ url('/members/courses/' . $course->id . '/forums/new') }}" class="genric-btn rounded centered primary" style="display: inline-block;">New Forum</a>
						</div>
					</div>
				</div>
				@else
				<div class="col-lg-5 col-md-6 col-sm-10 col-12">
					<div style="background: #5A5A5A; border-radius: 8px;" class="p-32">
						<h5 class="text-center white mb-2">No Course Forums</h5>
						<p class="text-center white">There are currently no active forums for this course. Click below to get started on creating the first forum.</p>
						<a href="{{ url('/members/courses/' . $course->id . '/forums/new') }}" class="genric-btn rounded centered primary">New Forum</a>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
@endsection