@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<h1 class="mobile-text-center mb-32" id="timer" style="font-size: 56px;">25:00</h1>
				<button type="button" id="start_session_button" class="genric-btn primary rounded mobile-center-button" style="font-size: 16px;">Start Session</button>
				<button type="button" id="pause_session_button" class="genric-btn success rounded mobile-center-button" style="font-size: 16px; display: none;">Pause Session</button>
				<button type="button" id="end_session_button" class="genric-btn danger rounded mobile-center-button" style="font-size: 16px; display: none;">End Session</button>
			</div>

			<div class="col-lg-5 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center">Your Session</h4>
					<hr />
					<div class="row mt-16">
						<div class="col-6">
							<h6>Start Time:</h6>
						</div>

						<div class="col-6">
							<h6 style="float: right;" id="start_time"></h6>
						</div>
					</div>

					<div class="row mt-16">
						<div class="col-6">
							<h6>Cycles:</h6>
						</div>

						<div class="col-6">
							<h6 style="float: right;" id="cycles"></h6>
						</div>
					</div>

					<div class="row mt-16">
						<div class="col-6">
							<h6>Total Time:</h6>
						</div>

						<div class="col-6">
							<h6 style="float: right;" id="session_time">0 seconds</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var total_time = 0;
		var isPaused = false;
		var cycles = 0;

		function startTimer(duration, display) {
		    var timer = duration, minutes, seconds;
		    setInterval(function () {
		    	if (isPaused == false) {
		    		minutes = parseInt(timer / 60, 10);
			        seconds = parseInt(timer % 60, 10);

			        minutes = minutes < 10 ? "0" + minutes : minutes;
			        seconds = seconds < 10 ? "0" + seconds : seconds;

			        display.html(minutes + ":" + seconds);

			        if (--timer < 0) {
			            display.html('25:00');
			            $("#start_session_button").fadeIn();
			        }

			        total_time += 1;
			        $("#session_time").html(total_time + " seconds");
		    	}
		    }, 1000);
		}

		function formatAMPM(date) {
			var hours = date.getHours();
			var minutes = date.getMinutes();
			var ampm = hours >= 12 ? 'pm' : 'am';
			hours = hours % 12;
			hours = hours ? hours : 12; // the hour '0' should be '12'
			minutes = minutes < 10 ? '0'+minutes : minutes;
			var strTime = hours + ':' + minutes + ' ' + ampm;
			return strTime;
		}

		$(document).ready(function() {
			var start_time = new Date();
			var formatted = formatAMPM(start_time);
			$("#start_time").html(formatted + " on " + monthNames[start_time.getMonth()] + " " + start_time.getDate());

			$("#cycles").html(cycles);
		});

		$("#start_session_button").on('click', function() {
			var timerDuration = 60 * 25;
			var display = $("#timer");
			startTimer(timerDuration, display);

			$(this).fadeOut("fast");
			$("#pause_session_button").delay(800).fadeIn();
			$("#end_session_button").delay(800).fadeIn();
		});

		$("#pause_session_button").on('click', function() {
			if (isPaused == false) {
				isPaused = true;
				$(this).removeClass('success');
				$(this).addClass('info');
				$(this).html('Continue Session');
			} else {
				isPaused = false;
				$(this).removeClass('info');
				$(this).addClass('success');
				$(this).html('Pause Session');
			}
		});
	</script>
@endsection