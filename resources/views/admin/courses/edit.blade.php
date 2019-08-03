<span class="red">*</span>@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_course_form" action="/admin/courses/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="course_id" value="{{ $course->id }}">
						<div class="form-group">
							<h3>Create a New Course</h3>
							<p>Fields with <span class="red">*</span> are required.</p>
						</div>

						<div class="form-group">
							<label>Title<span class="red">*</span>:</label>
							<input type="text" class="form-control" value="{{ $course->title }}" name="title" required>
						</div>

						<div class="form-group">
							<label>Description<span class="red">*</span>:</label>
							<textarea class="form-control" rows="5" name="description" form="update_course_form" required>{{ $course->description }}</textarea>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Image URL<span class="red">*</span>:</label>
								<input type="text" name="image_url" value="{{ $course->image_url }}" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>YouTube Video ID:</label>
								<input type="text" name="youtube_id" value="{{ $course->youtube_id }}" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12" id="price_input">
								<label>Price:</label>
								<input type="number" class="form-control" name="price" value="{{ $course->price }}" min="0.50" step="0.01">
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12" id="stripe_plan_selection" style="display: none;">
								<label>Select Stripe Plan:</label>
								<select id="stripe_plan" form="update_course_form" class="form-control" name="plan_id">
									<option <?php if($course->plan_id == "") { echo "selected" ;}  ?> value="">N/A</option>
									@foreach($plans as $plan)
									<option <?php if($course->plan_id == $plan["id"]) { echo "selected" ;} ?> data-price="{{ $plan["amount"] }}" value="{{ $plan["id"] }}">{{ $plan["name"] }} - ${{ sprintf("%.2f", $plan["amount"] / 100) }}<?php if ($plan["interval"] == "month") { echo "/mo"; } ?> <?php if($plan["trial_period_days"] > 0) { echo "(" . $plan["trial_period_days"] . " days trial)"; }?></option>
									@endforeach
								</select>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Monthly Subscription<span class="red">*</span>:</label>
								<select form="update_course_form" class="form-control" name="monthly">
									<option value="0" <?php if ($course->monthly == 0) { echo "selected"; } ?>>No</option>
									<option value="1" <?php if ($course->monthly == 1) { echo "selected"; } ?>>Yes</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn" value="Update Course">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		$("#stripe_plan").on('change', function() {
			var price = $(this).find(":selected").attr('data-price');
			$("input[name=price]").val(price);
		});

		$("select[name=monthly]").on('change', function() {
			displayStripe();
		});

		function displayStripe() {
			if ($("select[name=monthly]").val() == "0") {
				$("input[name=price]").val('{{ $course->price }}');
				$("#price_input").show();
				$("#stripe_plan_selection").hide();
			} else {
				$("#price_input").hide();
				$("#stripe_plan_selection").show();
			}
		}

		$(document).ready(function() {
			displayStripe();
		});
	</script>
@endsection