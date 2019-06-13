@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center" style="display: flex;">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12" style="margin: auto;">
				<h3 class="mb-3">Get the Tools You Need to Master the Self</h3>
				<p>We can teach you how to master the self but then we can also give you the tools you need to master the self. Once you combine knowledge with practical tools, you've got a killer combination.</p>
				<p>We've got a team of website developers that are ready to meet your needs. We will come up with one software tool per month that can truly help you master the self. If you would like access to these tools, make an account! Some tools will be free while others will be premium.</p>
				<p>Finally, we're dedicated to helping you master the self, so we continually are creating new tools to help you. If you have a suggestion for what software tool to make next, fill out the form and we'll consider creating the tool for the community.</p>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<form id="suggestion_form" action="/tools/suggestion/submit" method="POST">
						{{ csrf_field() }}
						<h4 class="text-center mb-1">Suggest a Tool for the Community</h4>
						<div class="form-group">
							<hr />
							<h5 class="mb-1">Name:</h5>
							<input type="text" name="name" class="form-control mb-2" required>
							<p class="mb-1">If we develop the software tool, we want to be able to credit you to the community.</p>
							<hr />
						</div>

						<div class="form-group">
							<h5 class="mb-2">Title of Tool:</h5>
							<input type="text" name="title" class="form-control mb-2" required>
							<p class="mb-1">What would you name the tool that you are thinking of?</p>
							<hr />
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description of Tool:</h5>
							<textarea class="form-control mb-2" rows="3" form="suggestion_form" name="description" required></textarea>
							<p class="mb-1">What would this tool do? How will it benefit the Mind of Habit community?</p>
							<hr />
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn info rounded centered" value="Submit Suggestion">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div style="background: #EAEAEA;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h1 class="text-center mb-32">Our Current Tools</h1>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<ul class="list-group">
						<a href="{{ url('/tools/pomodoro') }}" class="blog-link">
							<li class="list-group-item">
								<h3 class="mb-2 blue">Pomodoro Tool</h3>
								<p class="mb-1">Want to know how successful people get more work done in less time? It's because they're able to focus their energy at one task at a time, which helps them do a better job in less time.</p>
								<p class="mb-1">This tool is designed to help you acheive better focus. Not only that, you can see if you're getting better at your ability to focus and see your progress over time.</p>
								<p class="mb-1">Unlike many Pomodoro tools out there, this isn't just a simple countdown timer. This Pomodoro tool keeps track of the number of Pomodoro sessions you've had, how long each session has been, how many cycles per session and much more. This is not only a tool to help you focus, but it is also a tool that gives you feedback with your data.</p>
								<p class="mb-1"><b>Category: </b> Focus</p>
							</li>
						</a>
						<a href="{{ url('/tools/student') }}" class="blog-link">
							<li class="list-group-item">
								<h3 class="mb-2 blue">Student Planner Tool</h3>
								<p class="mb-1">Being a student is tough and being a successful student is even tougher. So how do the successful students get ahead? Are they just smarter than the rest? Are they just gifted? In rare cases, this is true, however, most successful students don't have Einstein level IQs. They just know how to prioritize better.</p>
								<p class="mb-1">Being able to prioritize your studying schedule is exactly what this tool aims to help you with. By breaking down each task into its components, you'll be able to quickly see which tasks are a higher priority than others. This will help you overcome the stress of having a million things to do and give you the freedom to focus and learn faster.</p>
								<p class="mb-1"><b>Category: </b> Prioritization</p>
							</li>
						</a>
						<a href="{{ url('/tools/rice') }}" class="blog-link">
							<li class="list-group-item">
								<h3 class="mb-2 blue">RICE Planner Tool</h3>
								<p class="mb-1">The most effective and productive people have the same 24 hours as everyone else. So how are they able to make more of an impact in their work or business in the same amount of time? Not only are they able to focus, they prioritize effectively.</p>
								<p class="mb-1">This is exactly what this tool aims to do. Its aim is to help you become better at prioritizing tasks so you can work on things that matter and will have an impact. Creating a to-do list is no longer enough, you need to have a to-do list that is ordered by priority.</p>
								<p class="mb-1">So how can we prioritize tasks? Well, that's where our tool can help you. You break down each task into its components and from there, each task is assigned a priority score. After you create your to-do list and load up all your tasks, all you have to do is click one button to get a to-do list that is ordered by priority. This will help you focus on the things that have a higher impact on your work or business.</p>
								<p class="mb-1">So if you're ready to start making a larger impact on your work or business, then click below to get started on your 7-day free trial. After your 7-day free trial is over, it's just $4.97/mo!</p>
								<p class="mb-1"><b>Category: </b> Prioritization</p>
							</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection