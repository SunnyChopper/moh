@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_recommendation_form" action="/admin/personal-coaching/recommendations/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">
						<input type="hidden" name="r_id" value="{{ $recommendation->id }}">	

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" class="form-control" name="title" value="{{ $recommendation->title }}" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea class="form-control" name="description" form="update_recommendation_form" rows="5">{{  $recommendation->description }}</textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">URL Link<span class="red">*</span>:</h5>
							<input type="url" class="form-control" name="link" value="{{ $recommendation->link }}" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Link Type<span class="red">*</span>:</h5>
							<select form="update_recommendation_form" name="type" class="form-control">
								<option value="1" <?php if($recommendation->type == 1) { echo "selected"; } ?>>Article</option>
								<option value="2" <?php if($recommendation->type == 2) { echo "selected"; } ?>>Video</option>
								<option value="3" <?php if($recommendation->type == 3) { echo "selected"; } ?>>Book</option>
								<option value="4" <?php if($recommendation->type == 4) { echo "selected"; } ?>>Movie</option>
								<option value="5" <?php if($recommendation->type == 5) { echo "selected"; } ?>>URL Link</option>
							</select>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary rounded centered" value="Update Recommendation">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection