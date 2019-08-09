@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				@if($course->youtube_id != "")
				<div class="videoWrapper">
				    <!-- Copy & Pasted from YouTube -->
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/{{ $course->youtube_id }}?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>
				@else
				<img src="{{ $course->image_url }}" class="regular-image-100">
				@endif

				<h3 class="mt-32">{{ $course->title }}</h3>
				@if($course->price != 0.00)
				<h4 class="mt-2 mb-2">${{ sprintf("%.2f", $course->price) }}</h4>
				@else
				<h4 class="mt-2 mb-2">Free</h4>
				@endif
				<p>{{ $course->description }}</p>

				<div style="background: hsla(0, 0%, 95%); padding: 24px;" class="mt-32">
					<h4 class="light-font">What You Will Be Learning</h4>
					<div class="accordion mt-16" id="modules_accordion">
						<?php $i = 0; ?>
						@foreach($modules as $module)
						<div class="card">
							<div class="card-header">
								<h2 class="mb-0">
									<h5 class="light-font" data-toggle="collapse" data-target="#collapse_{{ $i }}">
										{{ $module->title }}
									</h5>
								</h2>
							</div>

							<?php

								$videos = \App\CourseVideo::where('module_id', $module->id)->where('is_active', 1)->get();

							?>

							@if($i == 0)
							<div id="collapse_{{ $i }}" class="collapse show" data-parent="#modules_accordion">
							@else
							<div id="collapse_{{ $i }}" class="collapse" data-parent="#modules_accordion">
							@endif
								<div class="card-body">
									@if(count($videos) > 0)
									<ul class="list-group">
										@foreach($videos as $video)
										<li class="list-group-item">
											<h6 class="light-font">{{ $video->title }}</h6>
										</li>
										@endforeach
									</ul>
									@else
									<p class="mb-0">No content has been added for this module.</p>
									@endif
								</div>
							</div>
						</div>
						<? $i++; ?>
						@endforeach
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h5 class="text-center">Enroll in Course</h5>
					

					@if($course->price == 0.00)
						@if(Auth::guest())
							<p class="black text-center">If you do not have an account with Mind of Habit, click the button below to get registered and enrolled at the same time.</p>
							<a href="{{ url('/register?redirect_action=/courses/' . $course->id . '/enroll') }}" class="genric-btn primary rounded centered mb-4">Register and Enroll</a>
							<p class="black text-center">If you already have an account, click the button below to login and enroll.</p>
							<a href="{{ url('/login?redirect_action=/courses/' . $course->id . '/enroll') }}" class="genric-btn info rounded centered mb-0">Login and Enroll</a>
						@else
							@if(App\Custom\CourseHelper::isUserAuthorizedForCourse($course->id) == true)
								<a href="{{ url('/members/courses/' . $course->id . '/dashboard') }}" class="genric-btn primary rounded centered">Go to Course Dashboard</a>
							@else
								<a href="{{ url('/courses/' . $course->id . '/enroll') }}" class="genric-btn info rounded centered">Enroll in Course</a>
							@endif
						@endif
					@else
						@if(Auth::guest())
						<div id="stepOne">
							<h5 class="text-center mt-16">Step 1 of 2: Create an Account</h5>
							<p class="mb-1 text-center"><small>Fields with <span class="red">*</span> are required.</small></p>
							<div class="form-group row mt-16">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>First Name: <span class="red">*</span></label>
									<input type="text" class="form-control" id="create_account_first_name">
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
									<label>Last Name:</label>
									<input type="text" class="form-control" id="create_account_last_name">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Username: <span class="red">*</span></label>
									<input type="text" class="form-control" id="create_account_username">
									<p id="username_taken" class="mb-0 red" style="display: none;"><small>Username already taken.</small></p>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Email: <span class="red">*</span></label>
									<input type="email" class="form-control" id="create_account_email">
									<p id="email_taken" class="mb-0 red" style="display: none;"><small>Email already taken.</small></p>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Password: <span class="red">*</span></label>
									<input type="password" class="form-control" id="create_account_password">
									<p class="mb-0 mt-1"><small><strong>Password: </strong> <span id="password_feedback"></span></small></p>
								</div>
							</div>

							<p class="text-center red" id="register_feedback" style="display: none;"></p>

							<div class="form-group row">
								<div class="col-12">
									<button type="button" class="genric-btn primary rounded small centered register">Register</button>
								</div>
							</div>

							<p class="background-line text-center"><span>or</span></p>

							<h5 class="text-center mt-16">Step 1 of 2: Login</h5>
							<div class="form-group row mt-16">
								<div class="col-12">
									<label>Username: <span class="red">*</span></label>
									<input type="text" class="form-control" id="login_account_username">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Password: <span class="red">*</span></label>
									<input type="password" class="form-control" id="login_account_password">
								</div>
							</div>

							<p class="text-center red" id="login_feedback" style="display: none;"></p>

							<div class="form-group row">
								<div class="col-12">
									<button type="button" class="genric-btn info rounded small centered login">Login</button>
								</div>
							</div>
						</div>

						<div id="stepTwo" style="display: none;">
							<h5 class="text-center mt-16">Step 2 of 2: Payment Information</h5>
							<p class="mb-1 text-center"><small>Fields with <span class="red">*</span> are required.</small></p>

							<div class="form-group row">
								<div class="col-12">
									<label>Card Number:</label>
									<input type="text" class="form-control" id="card_number">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>Expiry Month:</label>
									<select class="form-control" id="ccExpiryMonth">
										<option value="01">01 - Jan</option>
										<option value="02">02 - Feb</option>
										<option value="03">03 - Mar</option>
										<option value="04">04 - Apr</option>
										<option value="05">05 - May</option>
										<option value="06">06 - Jun</option>
										<option value="07">07 - Jul</option>
										<option value="08">08 - Aug</option>
										<option value="09">09 - Sep</option>
										<option value="10">10 - Oct</option>
										<option value="11">11 - Nov</option>
										<option value="12">12 - Dec</option>
									</select>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>Expiry Year:</label>
									<select class="form-control" id="ccExpiryYear">
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
										<option value="2031">2031</option>
										<option value="2032">2032</option>
										<option value="2033">2033</option>
										<option value="2034">2034</option>
										<option value="2035">2035</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Security Code:</label>
									<input type="text" class="form-control" id="cvvNumber">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-6">
									<h6 class="text-left">Total:</h6>
								</div>
								<div class="col-6">
									<h6 class="text-right">${{ sprintf("%.2f", $course->price) }}</h6>
								</div>
							</div>

							@if($course->monthly == 1)
							<div class="form-group row">
								<div class="col-12">
									<p class="text-center"><small>You will be charged ${{ sprintf("%.2f", $course->price) }} every month.</small></p>
								</div>
							</div>
							@endif

							<div class="row" style="display: flex;">
								<div class="col-7" style="margin: auto;">
									<img src="https://www.wrenvironmental.com/wp-content/uploads/2018/09/major-credit-card-logos-png-5.png" class="regular-image-100">
								</div>

								<div class="col-5" style="margin: auto;">
									<img src="https://www.gwotmemorialfoundation.org/wp-content/uploads/2015/11/SSL-logo.png" class="regular-image-100">
								</div>
							</div>

							<div class="form-group row mt-16">
								<div class="col-12">
									<button type="button" class="genric-btn primary rounded centered enroll" style="font-size: 15px;">Enroll in Course</button>
								</div>
							</div>
						</div>
						@else
						<div id="stepTwo">
							<h5 class="text-center mt-16">Step 2 of 2: Payment Information</h5>
							<p class="mb-1 text-center"><small>Fields with <span class="red">*</span> are required.</small></p>

							<div class="form-group row">
								<div class="col-12">
									<label>Card Number:</label>
									<input type="text" class="form-control" id="card_number">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>Expiry Month:</label>
									<select class="form-control" id="ccExpiryMonth">
										<option value="01">01 - Jan</option>
										<option value="02">02 - Feb</option>
										<option value="03">03 - Mar</option>
										<option value="04">04 - Apr</option>
										<option value="05">05 - May</option>
										<option value="06">06 - Jun</option>
										<option value="07">07 - Jul</option>
										<option value="08">08 - Aug</option>
										<option value="09">09 - Sep</option>
										<option value="10">10 - Oct</option>
										<option value="11">11 - Nov</option>
										<option value="12">12 - Dec</option>
									</select>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>Expiry Year:</label>
									<select class="form-control" id="ccExpiryYear">
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
										<option value="2031">2031</option>
										<option value="2032">2032</option>
										<option value="2033">2033</option>
										<option value="2034">2034</option>
										<option value="2035">2035</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-12">
									<label>Security Code:</label>
									<input type="text" class="form-control" id="cvvNumber">
								</div>
							</div>

							<div class="form-group row">
								<div class="col-6">
									<h4 class="text-left">Today's Total:</h4>
								</div>
								<div class="col-6">
									<h4 class="text-right">${{ sprintf("%.2f", $course->price) }}</h4>
								</div>
							</div>

							@if($course->monthly == 1)
							<div class="form-group row">
								<div class="col-12">
									<p class="text-center"><small>You will be charged ${{ sprintf("%.2f", $course->price) }} every month.</small></p>
								</div>
							</div>
							@endif

							<div class="row" style="display: flex;">
								<div class="col-7" style="margin: auto;">
									<img src="https://www.wrenvironmental.com/wp-content/uploads/2018/09/major-credit-card-logos-png-5.png" class="regular-image-100">
								</div>

								<div class="col-5" style="margin: auto;">
									<img src="https://www.gwotmemorialfoundation.org/wp-content/uploads/2015/11/SSL-logo.png" class="regular-image-100">
								</div>
							</div>

							<p class="text-center green mt-2 mb-0" id="success_payment" style="display: none;">Successfully enrolled! Redirecting you to course dashboard...</p>
							<p class="text-center red mt-2 mb-0" id="payment_error" style="display: none;">Please enter in all fields.</p>

							<div class="form-group row mt-16">
								<div class="col-12">
									<button type="button" class="genric-btn primary rounded centered enroll" style="font-size: 15px;">Enroll in Course</button>
								</div>
							</div>
						</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		var _token = '{{ csrf_token() }}';
		var course_id = {{ $course->id }};
		@if(Auth::guest())
		var user_id = 0;
		var user_email = '';
		@else
		var user_id = {{ Auth::id() }};
		var user_email = '{{ Auth::user()->email }}';
		@endif

		function disableRegisterButton() {
			$(".register").attr('disabled', true);
			$(".register").removeClass('primary');
			$(".register").addClass('disabled');
		}

		function enableRegisterButton() {
			$(".register").attr('disabled', false);
			$(".register").removeClass('disabled');
			$(".register").addClass('primary');
		}

		$(".login").on('click', function() {
			var username = $('#login_account_username').val();
			var password = $('#login_account_password').val();

			$.ajax({
				url : '/api/users/login',
				type : 'POST',
				data : {
					'_token' : _token,
					'username' : username,
					'password' : password
				},
				success : function(data) {
					if (data == 1) {
						$.when($('#stepOne').fadeOut()).then(function() {
							$("#stepTwo").fadeIn();
						});
					} else if (data == 0) {
						$("#login_feedback").html('Password is incorrect.');
						$("#login_feedback").show();
					} else {
						$("#login_feedback").html('No account associated with that username.');
						$("#login_feedback").show();
					}
				}
			});
		});

		$(".register").on('click', function() {
			var first_name = $("#create_account_first_name").val();
			var last_name = $("#create_account_last_name").val();
			var username = $("#create_account_username").val();
			var email = $("#create_account_email").val();
			var password = $("#create_account_password").val();

			if (first_name != "" && username != "" && email != "" && password != "") {
				$("#register_feedback").html('Please fill all fields.');
				$("#register_feedback").show();
			}  else {
				$("#register_feedback").hide();

				$.ajax({
					url : '/api/users/create',
					type : 'POST',
					data : {
						'_token' : _token,
						'first_name' : first_name,
						'last_name' : last_name,
						'username' : username,
						'email' : email,
						'password' : password
					},
					success : function(data) {
						user_id = data;
						user_email = $("#create_account_email").val();
						$.when($('#stepOne').fadeOut()).then(function() {
							$("#stepTwo").fadeIn();
						});
					}
				});
			}
		});

		$(".enroll").on('click', function() {
			var card_number = $("#card_number").val();
			var ccExpiryMonth = $("#ccExpiryMonth").val();
			var ccExpiryYear = $("#ccExpiryYear").val();
			var cvvNumber = $("#cvvNumber").val();

			if (card_number != "" && ccExpiryMonth != "" && ccExpiryYear != "" && cvvNumber != "") {
				$("#payment_error").hide();
				$.ajax({
					url : '/api/courses/enroll',
					type : 'POST',
					data : {
						'_token' : _token,
						'user_id' : user_id,
						'course_id' : course_id,
						'email' : user_email,
						'card_number' : card_number,
						'ccExpiryMonth' : ccExpiryMonth,
						'ccExpiryYear' : ccExpiryYear,
						'cvvNumber' : cvvNumber
					},
					success : function(data) {
						if (data == true) {
							$("#success_payment").show();
							setTimeout(function() {
								window.location.href = "/members/courses/" + course_id + "/dashboard";
							}, 2500);
							
						}
					}
				});
			} else {
				$("#payment_error").show();
			}
		});

		$("#create_account_username").on('change', function() {
			var username = $(this).val();
			var field = $(this);
			$.ajax({
				url : '/api/username/check',
				type : 'POST',
				data : {
					'_token' : _token,
					'username' : username
				},
				success : function(data) {
					if (data == true) {
						field.css('border', '1px solid red');
						$("#username_taken").show();
						disableRegisterButton();
					} else {
						field.css('border', '1px solid green');
						$("#username_taken").hide();
						enableRegisterButton();
					}
				}
			});
		});

		$("#create_account_email").on('change', function() {
			var email = $(this).val();
			var field = $(this);
			$.ajax({
				url : '/api/email/check',
				type : 'POST',
				data : {
					'_token' : _token,
					'email' : email
				},
				success : function(data) {
					if (data == true) {
						field.css('border', '1px solid red');
						$("#email_taken").show();
						disableRegisterButton();
					} else {
						field.css('border', '1px solid green');
						$("#email_taken").hide();
						enableRegisterButton();
					}
				}
			});
		});

		$("#create_account_password").on('keyup', function() {
			$("#password_feedback").html($(this).val());
		});

		$(document).ready(function() {
			
		});
	</script>
@endsection