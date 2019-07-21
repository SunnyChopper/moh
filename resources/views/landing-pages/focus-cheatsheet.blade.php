@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64 pt-32-mobile pb-32-mobile">
		<div class="row" style="display: flex;">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12" style="margin: auto;">
				<img src="https://www.theintrepidcatalyst.com/wp-content/uploads/2019/01/digital-354.png" class="regular-image-100">
			</div>

			<div class="col-12 mt-16-mobile d-md-none">
				<div class="gray-box">
					<div class="row">
						<div class="col-12">
							<h5 class="text-center">Get Your Ultimate Focus Checklist</h5>
						</div>
					</div>

					<div class="row mt-16" style="display: flex;">
						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="text" class="form-control" placeholder="First Name" name="first_name" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="text" class="form-control mt-16-mobile" placeholder="Last Name" name="last_name" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="email" class="form-control mt-16-mobile" placeholder="Email" name="email" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="submit" class="btn btn-primary full-width centered mt-16-mobile" value="Download Now">
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block" style="margin: auto;">
				<h3 class="mb-2 mt-32-mobile mobile-text-center">Use Science and Psychology to Maximize Your Focus and Get More Done in Less Time</h3>

				<p class="black mobile-text-center">Being able to focus on a single task without distractions is important if you're trying to get more work done in less time, however, we often find ourselves not being able to focus. This can get frustrating especially if you're someone who has big dreams and goals.</p>

				<p class="black mobile-text-center mb-0-mobile">The Ultimate Focus Checklist is a small checklist of actions that are backed by science, so you can ensure that you have the best chance to sit down, focus, and get a lot of work done.</p>

				<div style="border: 2px solid #EEEEEE; border-radius: 5px; padding: 12px;">
					<h4 class="mb-8">Over 300,000 People Trust Us</h4>
					<p class="black mb-0">Everyday, over 300,000 followers get self-development advice and content from Mind of Habit. We wouldn't have those many followers if we didn't what we're talking about.</p>
				</div>
			</div>
		</div>

		<div class="row mt-32 mt-0-mobile d-none d-md-block">
			<div class="col-12">
				<div class="gray-box">
					<div class="row">
						<div class="col-12">
							<h4 class="text-center">Get Your Ultimate Focus Checklist</h4>
						</div>
					</div>

					<div class="row mt-16" style="display: flex;">
						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="text" class="form-control" placeholder="First Name" name="first_name" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="text" class="form-control mt-16-mobile" placeholder="Last Name" name="last_name" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="email" class="form-control mt-16-mobile" placeholder="Email" name="email" required>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-sm-12 col-12" style="margin: auto;">
							<input type="submit" class="btn btn-primary full-width centered mt-16-mobile" value="Download Now">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="d-block d-md-none">
		<div style="background: #EAEAEA;">
			<div class="container pt-16 pb-16">
				<div class="row">
					<div class="col-12">
						<h5 class="text-center mb-16-mobile">Over 300,000 People Trust Us</h5>
						<p class="text-center black mb-0">Everyday, over 300,000 followers get self-development advice and content from Mind of Habit. We wouldn't have those many followers if we didn't what we're talking about.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="d-block d-md-none">
		<div class="container pt-16 pb-16">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-2 mt-16-mobile mobile-text-center">Use Science and Psychology to Maximize Your Focus and Get More Done in Less Time</h3>

					<p class="black mobile-text-center">Being able to focus on a single task without distractions is important if you're trying to get more work done in less time, however, we often find ourselves not being able to focus. This can get frustrating especially if you're someone who has big dreams and goals.</p>

					<p class="black mobile-text-center mb-16-mobile">The Ultimate Focus Checklist is a small checklist of actions that are backed by science, so you can ensure that you have the best chance to sit down, focus, and get a lot of work done.</p>
				</div>
			</div>
		</div>
	</div>

	@include('layouts.landing-page-footer')

	<style type="text/css">
		#header {
			display: none;
		}

		#mobile-nav-toggle {
			display: none;
		}

		.about-content {
			margin-top: 0px;
			padding: 50px 10px;
		}

		@media only screen and (max-width: 576px) {
			.about-content h1 {
				font-size: 32px;
			}
		}

		.footer-area {
			display: none;
		}

		#landing-page-footer {
			display: block;
		}

		.section-gap {
			padding: 64px 0px;
		}
	</style>
@endsection