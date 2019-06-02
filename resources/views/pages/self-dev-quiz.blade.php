@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h3 class="text-center">Learn How Self-Development Can Help You</h3>
				<p class="text-center mt-8">We designed this quiz to help you pinpoint how self-development can help you take your career to the next level.</p>
			</div>
		</div>

		<div class="row mt-32 justify-content-center">
			<div class="col-lg-8 col-md-9 col-sm-10 col-12">
				<div class="gray-box">
					<h5 class="mb-8">Quiz Progress</h5>
					<div class="progress mb-32">
						<div class="progress-bar" style="width:0%;">0/15</div>
					</div>
					<div id="question-container">
						<h4 id="question" data-question="1">I truly understand what my strengths are.</h4>
						<ul class="list-group mt-16">
							<li class="list-group-item response" id="5">Strongly Agree</li>
							<li class="list-group-item response" id="4">Agree</li>
							<li class="list-group-item response" id="3">Neutral</li>
							<li class="list-group-item response" id="2">Disagree</li>
							<li class="list-group-item response" id="1">Strongly Disagree</li>
						</ul>
					</div>

					<div id="results-container" style="display: none;">
						<h3>Your Results</h3>
						<hr />
						<h6 class="mb-2"><b>Self-awareness: </b> <span id="sa"></span></h6>
						<h6 class="mb-2"><b>Focus: </b> <span id="f"></span></h6>
						<h6 class="mb-2"><b>Self-discipline: </b> <span id="sd"></span></h6>
						<h6 class="mb-2"><b>Habits: </b> <span id="ha"></span></h6>
						<h6 class="mb-2"><b>Health: </b> <span id="he"></span></h6>
						<h6 class="mb-2"><b>Self-fulfillment: </b> <span id="sf"></span></h6>

						<h3 class="mt-32">What Does This Mean For You</h3>
						<div id="dynamic_html" class="mt-8">
						</div>
						<p>That being said, we'll make you a one-time offer for a free consultation. Get on the phone, talk out your situation, and we'll see exactly how we can help you master the self. We'll even throw in a gift for getting on the phone.</p>
						<p>Again, this is a one-time offer, so you won't get this anywhere else on the site.</p>
						<h4 class="mt-32">Sign up for a free consultation</h4>
						<form id="submit_consultation_form" action="/consultation/submit" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="sa_percentage">
							<input type="hidden" name="f_percentage">
							<input type="hidden" name="sd_percentage">
							<input type="hidden" name="ha_percentage">
							<input type="hidden" name="he_percentage">
							<input type="hidden" name="sf_percentage">
							<input type="hidden" name="timezone">

							<div class="form-group row mt-16">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>First Name:</label>
									<input type="text" class="form-control" name="first_name" required>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-8-mobile">
									<label>Last Name:</label>
									<input type="text" class="form-control" name="last_name" required>
								</div>
							</div>

							<div class="form-group row mt-16">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-8-mobile">
									<label>Select App:</label>
									<select name="app" form="submit_consultation_form" class="form-control">
										<option value="Instagram">Instagram</option>
										<option value="Skype">Skype</option>
										<option value="Facebook Messenger">Facebook Messenger</option>
										<option value="WhatsApp">WhatsApp</option>
										<option value="Telegram">Telegram</option>
									</select>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-8-mobile">
									<label id="username_label">Instagram username:</label>
									<input type="text" class="form-control" name="contact" required>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-12">
									<label>Date:</label>
									<input type="date" name="meeting_date" class="form-control" required>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-8-mobile">
									<label>Time:</label>
									<input type="time" name="meeting_time" class="form-control" required>
								</div>
							</div>

							<div class="form-group mt-32">
								<input type="submit" class="genric-btn centered primary rounded" style="font-size: 15px;" value="Signup for Free Consultation">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		var responses = Array();

		$(document).ready(function() {
			var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
			$("input[name=timezone]").val(timezone);
		});

		$("select[name=app]").on('change', function() {
			var selected = $(this).val();

			if (selected == "Instagram") {
				$("#username_label").html('Instagram Username:');
			} else if (selected == "Skype") {
				$("#username_label").html('Skype Email/Username:');
			} else if (selected == "Facebook Messenger") {
				$("#username_label").html('Facebook Profile URL:');
			} else if (selected == "WhatsApp") {
				$("#username_label").html('WhatsApp Number:');
			} else {
				$("#username_label").html('Telegram Username:');
			}
		});

		$(".response").on('mouseover', function() {
			$(this).css('background', '#FAFAFA');
			$(this).css('cursor', 'pointer');
		});

		$(".response").on('mouseleave', function() {
			$(this).css('background', 'white');
		});

		$(".response").on('click', function() {
			// Get question number
			var question = $("#question").data('question');

			// Check to see if last question
			if (question == 15) {
				$("#question-container").fadeOut("normal", function() {
			        $(this).remove();

			        // Calculate scores
			        var sa1 = responses[0];
			        var sa2 = responses[1];
			        var sa3 = responses[2];

			        var f1 = responses[3];
			        var f2 = responses[4];

			        var sd1 = responses[5];
			        var sd2 = responses[6];
			        var sd3 = responses[7];

			        var ha1 = responses[8];
			        var ha2 = responses[9];
			        var ha3 = responses[10];

			        var he1 = responses[11];
			        var he2 = responses[12];

			        var sf1 = responses[13];
			        var sf2 = responses[14];

			        var sa_score = parseInt(sa1) + parseInt(sa2) + parseInt(sa3);
			        var sa_percentage = (sa_score / 15) * 100;

			        var f_score = parseInt(f1) + parseInt(f2);
			        var f_percentage = (f_score / 10) * 100;

			        var sd_score = parseInt(sd1) + parseInt(sd2) + parseInt(sd3);
			        var sd_percentage = (sd_score / 15) * 100;

			        var ha_score = parseInt(ha1) + parseInt(ha2) + parseInt(ha3);
			        var ha_percentage = (ha_score / 15) * 100;

			        var he_score = parseInt(he1) + parseInt(he2);
			        var he_percentage = (he_score / 10) * 100;

			        var sf_score = parseInt(sf1) + parseInt(sf2);
			        var sf_percentage = (sf_score / 10) * 100;

			        $("#sa").html(sa_percentage.toFixed(2) + "%");
			        $("#f").html(f_percentage.toFixed(2) + "%");
			        $("#sd").html(sd_percentage.toFixed(2) + "%");
			        $("#ha").html(ha_percentage.toFixed(2) + "%");
			        $("#he").html(he_percentage.toFixed(2) + "%");
			        $("#sf").html(sf_percentage.toFixed(2) + "%");

			        $("input[name=sa_percentage]").val(sa_percentage);
			        $("input[name=f_percentage]").val(f_percentage);
			        $("input[name=sd_percentage]").val(sd_percentage);
			        $("input[name=ha_percentage]").val(ha_percentage);
			        $("input[name=he_percentage]").val(he_percentage);
			        $("input[name=sf_percentage]").val(sf_percentage);

			        var dynamic_html = "";

			        if ((sa_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>It seems that your self-awareness is lacking. This will cause you many problems in your workplace or your business. By not knowing where your strengths and weaknesses fall, you will not be able to work at your highest potential.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around self-awareness and we will find ways to help you gain more insight on yourself so you can always work at your highest potential.</p>";
			        }

			        if ((f_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>You seem to lack focus. Not having the ability to focus will hinder you from tapping into a fundamental part of human nature which is compounding effects or momentum. When you focus on a task or a mission, you start to build momentum towards success. However, if you cannot focus, you will constantly destroy your own momentum which will keep you average at best.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around focus and we will find ways that we can help you get laser focus to help you tap into compounding effects.</p>";
			        }

			        if ((sd_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>It seems that you lack self-discipline. This may mean that you lack the ability to control your own emotions or it might mean that your environment is too chaotic. Either way, a lack of self-discipline will stop you from pushing through at crucial moments. It will come in the form of not wanting to work when you're almost finished. It will come in the form of not wanting to workout when your muscles are feeling sore. It will come in many shapes and sizes, however, all of them are holding you back from finally going up a level in success.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around self-discipline and we will find ways to help you gain more self-discipline so you can finally start leveling up.</p>";
			        }

			        if ((ha_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>Your habits seem to not have your best interest in mind. Did you know that a majority of our day is actually done on auto-pilot? We let our habits control a majority of the day. So if you have bad habits, half of the day, you're already making bad decisions. Having the ability to destroy bad habits and create good habits is crucial to helping you break out of your bad patterns and get success on nearly auto-pilot.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around habits and we will find ways to help you break the old patterns, create new and better ones, and help you start getting success on basically auto-pilot.</p>";
			        }

			        if ((he_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>Your health does not seem supportive of your dreams and goals. In order to do big ambitious things, you need a lot of energy and if your health is slowly getting worse, you will start to have less and less energy over time, which will lead you to slow down on your progress towards success. Ultimately, you lose so much energy that you can no longer even focus and you start to lose to healthier employees or healthier CEOs.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around health and we will find ways to help you start building up your energy so you can keep pushing towards success.</p>";
			        }

			        if ((sf_percentage / 100) <= 0.6) {
			        	dynamic_html += "<p>It does not seem like you are finding happiness with what you do. This is a very bad sign. If you are not feeling fulfilled with your work, you are not likely to have the passion and drive to have focus, to have self-discipline, to have good health, to have good habits, and it will severely ruin your chances at being successful.</p>";
			        	dynamic_html += "<p>If you choose the free consultation, you can explain your situation around your Self-fulfillment and we will find ways to help you start being passionate and fulfilled with your work.</p>";
			        }

			        $("#dynamic_html").html(dynamic_html);

			        $("#results-container").fadeIn("slow");
			    });
			}

			// Get response
			var response = $(this).attr('id');

			// Push response to array
			responses.push(response);

			// Get the next question
			var nextQuestion = getNextQuestion(question);

			// Set the next question
			$("#question").html(nextQuestion);
			$("#question").data('question', question + 1);

			// Get progress bar
			var progress = (question / 15) * 100;
			$(".progress-bar").css('width', progress + "%");
			$(".progress-bar").html(question + "/15");
		});

		function getNextQuestion(question_id) {
			switch(question_id) {
				case 1:
					// Self-awareness
					return "I truly understand what my weaknesses are.";
					break;
				case 2:
					// Self-awareness
					return "I can place myself in situations where the odds of success are in my favor.";
					break;
				case 3:
					// Focus
					return "If needed, I can sit down and work on a project without losing focus.";
					break;
				case 4:
					// Focus
					return "I like to keep my working environment clean.";
					break;
				case 5:
					// Self-discipline
					return "I have a set time to go to sleep and wake up.";
					break;
				case 6:
					// Self-discipline
					return "If faced with a problem, I do not procrastinate and I work on it right away.";
					break;
				case 7:
					// Self-discipline
					return "If I say I am going to do something, I always follow through and make sure I complete the task.";
					break;
				case 8:
					// Habits
					return "I make sure to reward myself for a good day of work.";
					break;
				case 9:
					// Habits
					return "I find myself easily making good habits.";
					break;
				case 10:
					// Habits
					return "I find myself easily breaking bad habits.";
					break;
				case 11:
					// Health
					return "I tend to have consistent energy throughout the day.";
					break;
				case 12:
					// Health
					return "I find it easy to eat healthy food.";
					break;
				case 13:
					// Self-fulfillment
					return "I find it easy to wake up in the morning.";
					break;
				case 14:
					// Self-fulfillment
					return "I go to sleep happy with what I have done.";
					break;
				case 15:
					
					break;
				default:
					break;
			}
		}
	</script>
@endsection