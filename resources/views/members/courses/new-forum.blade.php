@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<form id="create_forum_form" action="/members/courses/forums/create" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="course_id" value="{{ $course->id }}">

					<div class="form-group">
						<label>Title:</label>
						<input type="text" name="title" class="form-control" required>
					</div>

					<div class="form-group">
						<label>Body:</label>
						<textarea name="description" form="create_forum_form" rows="6" class="form-control"></textarea>
					</div>

					<div class="form-group centered mt-32">
						<a href="{{ url('/members/courses/' . $course->id . '/dashboard') }}" class="genric-btn info rounded centered mt-8-mobile" style="font-size: 14px; display: inline-block;">Back to Course Dashboard</a>
						<input type="submit" value="Create Forum" class="genric-btn primary rounded centered mt-8-mobile" style="font-size: 14px; display: inline-block;">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection