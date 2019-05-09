@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_course_module_form" action="/admin/courses/modules/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="course_id" value="{{ $course->id }}">
						<input type="hidden" name="module_id" value="{{ $module->id }}">
						<div class="form-group">
							<h5>Title</h5>
							<p class="mb-2">This is what will show up in the courses. Treat it like a summary.</p>
							<input type="text" class="form-control" name="title" value="{{ $module->title }}" required>
						</div>

						<div class="form-group">
							<h5>Description:</h5>
							<p class="mb-2">If someone clicks to get more information about a module, this is the description that will show.</p>
							<textarea class="form-control" name="description" form="update_course_module_form" rows="5" required>{{ $module->description }}</textarea>
						</div>

						<div class="form-group">
							<h5>Order:</h5>
							<p class="mb-2">This is the order of the modules in the course. For example, by entering '1' here, this will be the 1st module loaded in the course.</p>
							<input type="number" class="form-control" name="order" value="{{ $module->order }}" required>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn rounded" value="Update Module">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@endsection