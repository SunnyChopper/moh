@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.premium-content.modals.delete')

	<div class="container mt-64 mb-64">
		<div class="row">
			@if(count($premium_content) > 0)
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
				<a href="/admin/premium/new" class="site-btn mb-16">Create New Premium Content</a>
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr style="text-align: center;">
								<th>Title</th>
								<th>Featured Image</th>
								<th>YouTube Video ID</th>
								<th>Created At</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($premium_content as $content)
								<tr style="text-align: center;">
									<td style="vertical-align: middle;">{{ $content->title }}</td>

									@if($content->featured_image_url != "")
										<td style="max-width: 200px; vertical-align: middle;"><img src="{{ $content->featured_image_url }}" class="regular-image"></td>
									@else
										<td style="vertical-align: middle;">No image</td>
									@endif
									<td style="vertical-align: middle;">{{ $content->youtube_video_id }}</td>
									<td style="vertical-align: middle;">{{ $content->created_at->format('M jS, Y') }}</td>
									<td style="vertical-align: middle;">
										<a href="/admin/premium/edit/{{ $content->id }}" class="btn btn-info rounded small">Edit</a>
										<button id="{{ $content->id}}" class="btn delete_premium_content_button btn-danger rounded small">Delete</button>
									</td>
								</tr>
							@endforeach	
						</tbody>
					</table>
				</div>


			</div>
			@else
				<div class="col-lg-8 offset-lg-2 col-lg-offset-2 col-md-10 offset-md-1 col-md-offset-1 col-sm-12 col-12">
					<div class="gray-box">
						<h3 class="text-center">No Premium Content</h3>
						<p class="text-center">Click on the button below to get started on the first premium content.</p>
						<div class="row">
							<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-12">
								<a href="/admin/premium/new" class="site-btn-small center-button">Create New</a>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		$(".delete_premium_content_button").on('click', function() {
			// Get content ID
			var content_id = $(this).attr('id');

			// Set in modal
			$("#delete_premium_content_id").val(content_id);

			// Show modal
			$("#delete_premium_content_modal").modal();
		});
	</script>
@endsection