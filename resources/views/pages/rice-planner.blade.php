@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h2 class="text-center mb-32">Making a Higher Impact in Less Time</h2>
				<img src="https://c1.sfdcstatic.com/content/dam/blogs/ca/Blog%20Posts/How%20to%20Increase%20Productivity%20Without%20Increasing%20Stress_Open%20Graph%20Image.png" class="regular-image-100 mb-32" style="border-radius: 8px;">
				<p class="text-center black">Want to know how some people are able to achieve more than others in the same 24 hours? It's because successful people prioritize what they need to do. They don't just blindly start working on something. They are very careful with how they spend their time and energy.</p>
				<p class="text-center black">So how can you do the same? How can you prioritize your tasks better? That's what the RICE Planner Tool aims to help you with. How does the RICE Planner Tool do this?</p>
				<p class="text-center black">Each task can be broken down into its four main components: reach, impact, confidence, and ease. By breaking down each task into these four components, you get something called a RICE score. This score will help you prioritize tasks more effectively and make more of an impact in your work or business in the same amount of time.</p>
				<p class="text-center black mb-32">Many before you have used this RICE Planner Tool to help them start prioritizing their tasks and make more of an impact, so what are you waiting for? Sign up below and get access to your 7-day free trial. After that, it's just $4.97 a month.</p>

				<div class="gray-box">
					<h3 class="text-center mb-16">Start Your 7-Day Free Trial</h3>
					<p class="text-center">Are you ready to start achieving more in the same 24 hours that everyone else has? Click below to get started on creating your free Mind of Habit account and activating your 7-day free trial! If you already have an account, click <a href="{{ url('/login?redirect_action=/members/rice/enroll') }}">here</a> to login and start your 7-day free trial!</p>
					<a href="{{ url('/register?redirect_action=/members/rice/enroll') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">I'm Ready to Get More Done</a>
				</div>
			</div>
		</div>
	</div>
@endsection