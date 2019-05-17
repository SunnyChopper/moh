@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="create_recommendation_form" action="/admin/personal-coaching/recommendations/create" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" class="form-control" name="title" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea class="form-control" name="description" form="create_recommendation_form" rows="5"></textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">URL Link<span class="red">*</span>:</h5>
							<input type="url" class="form-control" name="link" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Link Type<span class="red">*</span>:</h5>
							<select form="create_recommendation_form" name="type" class="form-control">
								<option value="1">Article</option>
								<option value="2">Video</option>
								<option value="3">Book</option>
								<option value="4">Movie</option>
								<option value="5">URL Link</option>
							</select>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary rounded centered" value="Create Recommendation">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection