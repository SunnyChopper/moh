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
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection