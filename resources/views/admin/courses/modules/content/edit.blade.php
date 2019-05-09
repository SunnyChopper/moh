@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<form id="update_content_form" action="/admin/courses/modules/content/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="module_id" value="{{ $module->id }}">
						<input type="hidden" name="course_id" value="{{ $course->id }}">
						<input type="hidden" name="content_id" value="{{ $content->id }}">

						<div class="form-group">
							<h5>Title</h5>
							<p class="mb-2">The title should summarize the video.</p>
							<input type="text" class="form-control" name="title" value="{{ $content->title }}" required>
						</div>

						<div class="form-group">
							<h5>Description</h5>
							<p class="mb-2">When a member clicks on the video, they will be able to read this description.</p>
							<textarea class="form-control" name="description" rows="5" form="update_content_form" required>{{ $content->description }}</textarea>
						</div>

						<div class="form-group">
							<h5>Order</h5>
							<p class="mb-2">This is the order of the videos in the module.</p>
							<input type="number" class="form-control" name="order" value="{{ $content->order }}" required>
						</div>

						<div class="form-group">
							<h5>YouTube ID</h5>
							<p class="mb-2">This is the ID of the YouTube video. Used in order to embed and more.</p>
							<input type="text" class="form-control" name="youtube_id" value="{{ $content->youtube_id }}" required>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn rounded" value="Update Content">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection