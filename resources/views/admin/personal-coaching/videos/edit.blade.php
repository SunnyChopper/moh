@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_video_form" action="/admin/personal-coaching/videos/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">
						<input type="hidden" name="vid_id" value="{{ $video->id }}">

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea class="form-control" name="description" form="update_video_form" rows="5" required>{{ $video->description }}</textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">YouTube Video ID<span class="red">*</span>:</h5>
							<input type="text" class="form-control" name="video_id" value="{{ $video->video_id }}" required>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary centered rounded mt-32" value="Update Video"> 
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection