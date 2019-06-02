@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container mt-64 mb-64 mt-32-mobile mb-32-mobile">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 col-lg-offset-1 col-md-10 offset-md-1 col-md-offset-1 col-sm-12 col-xs-12 col-12">
				<div class="gray-box">
					<h3 class="text-center">Edit Premium Content</h3>
					<p class="text-center"><b>Note: </b>Fields with <span class="red">*</span> are required.</p>
					<form action="/admin/premium/update" method="post" id="edit_premium_content_form">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $content->id }}" name="premium_content_id">
						<div class="form-group mb-64">
							<h5>Title<span class="red">*</span>:</h5>
							<p class="mb-2">This will be the title of the premium content.</p>
							<input type="text" name="title" value="{{ $content->title }}" class="form-control" required>
						</div>

						<div class="form-group mb-64">
							<h5>Featured Image URL:</h5>
							<p class="mb-2">If you want to include an image with the content, input the image URL here.</p>
							<input type="text" name="featured_image_url" value="{{ $content->featured_image_url }}" class="form-control" required>
						</div>

						<div class="form-group mb-64">
							<h5>Youtube Video URL:</h5>
							<p class="mb-2">If you want to include a YouTube video with the content, input the YouTube URL here.</p>
							@if($content->youtube_video_id != "")
								<input type="text" name="youtube_video_url" value="https://www.youtube.com?v={{ $content->youtube_video_id }}" class="form-control" required>
							@else
								<input type="text" name="youtube_video_url" class="form-control" required>
							@endif
						</div>

						<div class="form-group">
							<h5>Body:</h5>
							<p class="mb-2">This is the body of the post. Here's a nice little editor to make things easy.</p>
							<textarea id="blog_textarea" name="body" class="form-control" rows="15" form="edit_premium_content_form">{{ $content->body }}</textarea>
						</div>

						<div class="form-group">
							<input type="submit" value="Update Premium Content" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xq9hzw57g3zkmakqchurmgo9hnprenmg1yopn8cirghphy2x'></script>
	<script type="text/javascript">
		tinymce.init({
			selector: '#blog_textarea',
			plugins: "code"
		});
	</script>
@endsection