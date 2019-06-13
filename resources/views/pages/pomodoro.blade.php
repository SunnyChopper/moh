@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<h3 class="text-center mb-4">What is the Pomodoro Tool?</h3>
				<img src="https://cdn-images-1.medium.com/max/1600/1*R_S2oOzg5nI3e5VFHW1CKA.png" class="regular-image-100">
				<p class="text-center mb-16"><small>Credit: <a href="https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwiupO3wtuXiAhVhm-AKHaaaALgQjhx6BAgBEAM&url=https%3A%2F%2Fmedium.com%2Fthe-crossover-cast%2Fthe-pomodoro-technique-the-tomato-inspired-productivity-philosophy-ad3ba4cb2cfe&psig=AOvVaw1TA_zG1OCLDbOmEOn2SvRo&ust=1560479924105433" target="_blank">Medium</a></small></p>
				<p class="text-center black">Have you ever felt like you're trying to work but you're constantly getting distracted? That's the exact problem this tool aims to help. So how does the tool help you solve this?</p>
				<p class="text-center black">First, you start a countdown timer that goes on for 25 minutes. During these 25 minutes, you are to solely work. This means no Instagram, no Facebook, and no emails.</p>
				<p class="text-center black">Once your 25 minutes are up, you're free to do whatever you want to do. Generally, you want to reward yourself for finishing a lot of work. This trains the mind to enjoy working and build the habit of focusing.</p>
				<p class="text-center black mb-32">As you start to complete more cycles with ease, you will start to notice how easy it is to focus. At this point, you might not even need our Pomodoro tool to help you focus. That's the level of focus we want everyone in the Mind of Habit community to achieve.</p>

				<div class="gray-box">
					<h4 class="text-center mb-2">Are you ready to level up your focus?</h4>
					<p class="text-center black mb-8">Click the button below to create your Mind of Habit account and get started on your first Pomodoro session! If you already have a Mind of Habit account, simply <a href="{{ url('/login?redirect_action=/members/pomodoro') }}">login</a> and start using the tool for free.</p>
					<a href="{{ url('/register?redirect_action=/members/pomodoro') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">I'm Ready to Level Up My Focus</a>
				</div>
			</div>
		</div>
	</div>
@endsection