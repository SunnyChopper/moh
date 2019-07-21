@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="create_course_form" action="/admin/courses/create" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<h3>Create a New Course</h3>
							<p>Fields with <span class="red">*</span> are required.</p>
						</div>

						<div class="form-group">
							<label>Title<span class="red">*</span>:</label>
							<input type="text" class="form-control" name="title" required>
						</div>

						<div class="form-group">
							<label>Description<span class="red">*</span>:</label>
							<textarea class="form-control" rows="5" name="description" form="create_course_form" required></textarea>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Image URL<span class="red">*</span>:</label>
								<input type="text" name="image_url" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>YouTube Video ID:</label>
								<input type="text" name="youtube_id" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Price<span class="red">*</span>:</label>
								<input type="number" name="price" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Monthly Subscription<span class="red">*</span>:</label>
								<select form="create_course_form" class="form-control" name="monthly">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Select Stripe Plan:</label>
								<select form="create_course_form" class="form-control" name="plan_id">
									<option value="">N/A</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn" value="Create Course">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection