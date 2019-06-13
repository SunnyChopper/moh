@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h2 class="text-center mb-32">How Can You Become a Successful Student?</h2>
				<img src="https://www.bishop.edu/wp-content/uploads/2011/10/SocialSciences-Feature-Image.jpg" class="regular-image-100 mb-32" style="border-radius: 8px;">
				<p class="text-center black">There's a common misconception that you need to have an Einstein level IQ to be a successful student and if you don't have that level of IQ, you're pretty much doomed. Well we're here to tell you that this is not the case.</p>
				<p class="text-center black">Only in rare cases does IQ ever matter. What does matter more is how you prepare and prioritize as a student. While in school, you're most likely taking multiple different classes, which all require something from you whether it be homework, a quiz, or an exam.</p>
				<p class="text-center black">The most successful students know how to prioritize their time so they end up doing the most important tasks first and then move on to less important tasks. For example, an exam is most definitely more important than a small assignment. Your time and energy would be better used if you studied for the exam and gave that more time.</p>
				<p class="text-center black">Our free student planner tool is designed to help you easily prioritize your school work. You'll be able to break down each task into its major components and from there, each task is assigned a priority score. Your dashboard will then order your tasks from highest priority to lowest. This will allow you to work on higher priority tasks first and work your way down.</p>
				<p class="text-center black mb-32">So if you're a student that wants to become successful, this tool will definitely help you prioritize your time better and help you acheive better grades. Click below to get started for free!</p>

				<div class="gray-box">
					<h4 class="text-center">Ready to Become a Successful Student?</h4>
					<p class="text-center mb-16">If you're ready to start prioritizing your school work and become a successful student, then click on the button below to create your Mind of Habit account and access the tool. If you already have an account, click <a href="{{ url('/login?redirect_action=/members/student') }}">here</a> to login.</p>
					<a href="{{ url('/register?redirect_action=/members/student') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">I'm Ready to Become a Successful Student</a>
				</div>
			</div>
		</div>
	</div>
@endsection