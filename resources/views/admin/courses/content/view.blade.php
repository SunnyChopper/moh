@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($modules) > 0)
			@else
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Course Modules</h3>
					<p class="text-center">There are no modules for this course. Click below to get started.</p>
					<a href="/admin/courses/{{ $course->id }}/modules/new" class="primary-btn centered rounded">Create New Module</a>
				</div>
			</div>
			@endif
		</div>
	</div>
@endsection