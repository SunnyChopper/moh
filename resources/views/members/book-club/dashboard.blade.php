@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class='container pt-64 pb-64'>
		<div class='row justify-content-center'>
			<div class='col-lg-9 col-md-8 col-sm-12 col-12'>
				<h1 style="font-weight: 100;">Welcome Back {{ Auth::user()->first_name }}...</h1>
				<hr />
				<div class="gray-box">
					<div class="row" style="display: flex;">
						<div class="col-lg-3 col-md-3 col-sm-12 col-12" style="margin: auto;">
							<img src="{{ $active_book->cover_url }}" class="image-height-196 centered">
						</div>

						<div class="col-lg-9 col-md-6 col-sm-12 col-12" style="margin: auto;">
							<h2 class="mb-1" style="font-weight: 200;">{{ $active_book->title }}</h2>
							<h6 style="font-weight: 200;" class="mb-2">Current Book of the Week</h6>
							<p class="mb-3 black">{{ $active_book->description }}</p>
							<a href="{{ url('/members/book-club/1/dashboard') }}" class="genric-btn primary small rounded mobile-full-width mt-16-mobile mb-0">Go to Dashboard</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center mb-3">Quick Actions</h4>
					<button type="button" class="genric-btn medium info rounded full-width mb-2" style="font-size: 14px;">View Previous Books</button>
					<button type="button" class="genric-btn medium info rounded full-width mb-0" style="font-size: 14px;">View Forums</button>
				</div>
			</div>
		</div>
	</div>

	<div style="background: hsl(0, 0%, 95%);">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h1 class="text-center" style="font-weight: 100;" id="vote_title">Vote for the Next Book</h1>
				</div>
			</div>

			@if($user_vote == null)
			<div id="vote_step_one">
				<div class="row mt-64">
				<div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-16-mobile mb-16-mobile">
					<div id="vote_1" data-selected="false" class="selection_box">
						<img src="{{ $active_poll->book_1_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center">{{ $active_poll->book_1_title }}</h4>
					</div>

					@if($active_poll->book_1_amazon_url != "")
					<a class="genric-btn info centered small rounded mt-16" href="{{ $active_poll->book_1_amazon_url }}">Check on Amazon</a>
					@endif
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-16-mobile mb-16-mobile">
					<div id="vote_2" data-selected="false" class="selection_box">
						<img src="{{ $active_poll->book_2_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center">{{ $active_poll->book_2_title }}</h4>
					</div>

					@if($active_poll->book_2_amazon_url != "")
					<a class="genric-btn info centered small rounded mt-16" href="{{ $active_poll->book_2_amazon_url }}">Check on Amazon</a>
					@endif
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-16-mobile mb-16-mobile">
					<div id="vote_3" data-selected="false" class="selection_box">
						<img src="{{ $active_poll->book_3_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center">{{ $active_poll->book_3_title }}</h4>
					</div>

					@if($active_poll->book_3_amazon_url != "")
					<a class="genric-btn info centered small rounded mt-16" href="{{ $active_poll->book_3_amazon_url }}">Check on Amazon</a>
					@endif
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-12 mt-16-mobile mb-16-mobile">
					<div id="vote_4" data-selected="false" class="selection_box">
						<img src="{{ $active_poll->book_4_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center">{{ $active_poll->book_4_title }}</h4>
					</div>

					@if($active_poll->book_4_amazon_url != "")
					<a class="genric-btn info centered small rounded mt-16" href="{{ $active_poll->book_4_amazon_url }}">Check on Amazon</a>
					@endif
				</div>
				</div>

				<div class="row mt-64">
					<div class="col-12">
						<button type="button" class="genric-btn primary large rounded centered submit_vote_button" style="font-size: 16px;">Submit Vote</button>
					</div>
				</div>
			</div>
			@endif

			<div id="vote_step_two" style="display: none;">
				<div class="row mt-64">
					<div class="col-lg-3 col-md-3 col-sm-6 col-12">
						<img src="{{ $active_poll->book_1_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center mb-2">{{ $active_poll->book_1_title }}</h4>
						<div class="progress" style="height: 40px;">
							<div id="vote_1_percentage" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-12 mt-32-mobile">
						<img src="{{ $active_poll->book_2_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center mb-2">{{ $active_poll->book_2_title }}</h4>
						<div class="progress" style="height: 40px;">
							<div id="vote_2_percentage" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-12 mt-32-mobile">
						<img src="{{ $active_poll->book_3_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center mb-2">{{ $active_poll->book_3_title }}</h4>
						<div class="progress" style="height: 40px;">
							<div id="vote_3_percentage" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-12 mt-32-mobile">
						<img src="{{ $active_poll->book_4_image_url }}" class="image-height-196 centered mb-16">
						<h4 class="text-center mb-2">{{ $active_poll->book_4_title }}</h4>
						<div class="progress" style="height: 40px;">
							<div id="vote_4_percentage" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type='text/javascript'>
		@if($user_vote == null)
		var has_voted = false;
		@else
		var has_voted = true;
		@endif

		var selected = 0;
		var active_poll_id = {{ $active_poll->id }};
		var _token = '{{ csrf_token() }}';
		var user_id = {{ Auth::id() }};

		/* ----------------------- *\
			Helper functions
		\* ----------------------- */

		function toggleVote(vote) {
			switch(vote) {
				case 1:
					$("#vote_1").data('selected', 'true');
					$("#vote_2").data('selected', 'false');
					$("#vote_2").css('border', '2px solid #E0E0E0');
					$("#vote_3").data('selected', 'false');
					$("#vote_3").css('border', '2px solid #E0E0E0');
					$("#vote_4").data('selected', 'false');
					$("#vote_4").css('border', '2px solid #E0E0E0');
					break;
				case 2:
					$("#vote_1").data('selected', 'false');
					$("#vote_1").css('border', '2px solid #E0E0E0');
					$("#vote_2").data('selected', 'true');
					$("#vote_3").data('selected', 'false');
					$("#vote_3").css('border', '2px solid #E0E0E0');
					$("#vote_4").data('selected', 'false');
					$("#vote_4").css('border', '2px solid #E0E0E0');
					break;
				case 3:
					$("#vote_1").data('selected', 'false');
					$("#vote_1").css('border', '2px solid #E0E0E0');
					$("#vote_2").data('selected', 'false');
					$("#vote_2").css('border', '2px solid #E0E0E0');
					$("#vote_3").data('selected', 'true');
					$("#vote_4").data('selected', 'false');
					$("#vote_4").css('border', '2px solid #E0E0E0');
					break;
				case 4:
					$("#vote_1").data('selected', 'false');
					$("#vote_1").css('border', '2px solid #E0E0E0');
					$("#vote_2").data('selected', 'false');
					$("#vote_2").css('border', '2px solid #E0E0E0');
					$("#vote_3").data('selected', 'false');
					$("#vote_3").css('border', '2px solid #E0E0E0');
					$("#vote_4").data('selected', 'true');
					break;
				default: break;
			}
		}

		function getSelectedVote() {
			if ($("#vote_1").data('selected') == 'true') {
				return 1;
			}

			if ($("#vote_2").data('selected') == 'true') {
				return 2;
			}

			if ($("#vote_3").data('selected') == 'true') {
				return 3;
			}

			if ($("#vote_4").data('selected') == 'true') {
				return 4;
			}
		}

		function checkEmptySelection() {
			if (($("#vote_1").data('selected') == 'false' || $("#vote_2").data('selected') == false) && ($("#vote_2").data('selected') == 'false' || $("#vote_2").data('selected') == false) && ($("#vote_3").data('selected') == 'false' || $("#vote_3").data('selected') == false) && ($("#vote_4").data('selected') == 'false' || $("#vote_4").data('selected') == false)) {
				return true;
			} else {
				return false;
			}
		}

		function checkEmptyVotes() {
			if (checkEmptySelection() == true) {
				$(".submit_vote_button").prop('disabled', true);
				$(".submit_vote_button").removeClass('primary');
				$(".submit_vote_button").addClass('disabled');
			} else {
				$(".submit_vote_button").prop('disabled', false);
				$(".submit_vote_button").removeClass('disabled');
				$(".submit_vote_button").addClass('primary');
			}
		}

		function getResults() {
			$.ajax({
				url : '/api/book-club/polls/results',
				type : 'GET',
				data : {
					'poll_id' : active_poll_id
				},
				success : function(data) {
					var vote_1_percentage = data["1"] * 100;
					var vote_2_percentage = data["2"] * 100;
					var vote_3_percentage = data["3"] * 100;
					var vote_4_percentage = data["4"] * 100;

					$("#vote_1_percentage").html(vote_1_percentage + '%');
					$("#vote_1_percentage").css('width', vote_1_percentage + '%');
					$("#vote_2_percentage").html(vote_2_percentage + '%');
					$("#vote_2_percentage").css('width', vote_2_percentage + '%');
					$("#vote_3_percentage").html(vote_3_percentage + '%');
					$("#vote_3_percentage").css('width', vote_3_percentage + '%');
					$("#vote_4_percentage").html(vote_4_percentage + '%');
					$("#vote_4_percentage").css('width', vote_4_percentage + '%');
				}
			});
		}

		/* ----------------------- *\
			Button Bindings
		\* ----------------------- */

		$("#vote_1").on('click', function() {
			var selected = $(this).data('selected');
			if (selected == false || selected == "false") {
				$(this).css('border', '2px solid #f7631b');
				toggleVote(1);
			} else {
				$(this).css('border', '2px solid #E0E0E0');
				$(this).data('selected', 'false');
			}
		});

		$("#vote_2").on('click', function() {
			var selected = $(this).data('selected');
			if (selected == false || selected == "false") {
				$(this).css('border', '2px solid #f7631b');
				toggleVote(2);
			} else {
				$(this).css('border', '2px solid #E0E0E0');
				$(this).data('selected', 'false');
			}
		});

		$("#vote_3").on('click', function() {
			var selected = $(this).data('selected');
			if (selected == false || selected == "false") {
				$(this).css('border', '2px solid #f7631b');
				toggleVote(3);
			} else {
				$(this).css('border', '2px solid #E0E0E0');
				$(this).data('selected', 'false');
			}
		});

		$("#vote_4").on('click', function() {
			var selected = $(this).data('selected');
			if (selected == false || selected == "false") {
				$(this).css('border', '2px solid #f7631b');
				toggleVote(4);
			} else {
				$(this).css('border', '2px solid #E0E0E0');
				$(this).data('selected', 'false');
			}
		});

		$(".selection_box").on('click', function() {
			checkEmptyVotes();
		});

		$(".submit_vote_button").on('click', function() {
			var vote = getSelectedVote();

			$.ajax({
				url : '/api/book-club/polls/submit',
				type : 'POST',
				data : {
					'_token' : _token,
					'poll_id' : active_poll_id,
					'user_id' : user_id,
					'vote' : vote
				},
				success : function(data) {
					if (data == true) {
						// Switch views
						$("#vote_title").html('Voting Results');
						$.when($("#vote_step_one").fadeOut()).then(function() {
							$.when($("#vote_step_two").fadeIn()).then(function() {
								getResults();
							});
						});
					}
				}
			});
		});

		/* ----------------------- *\
			General
		\* ----------------------- */

		$(document).ready(function() {
			checkEmptyVotes();

			if (has_voted == true) {
				$("#vote_title").html('Voting Results');
				$("#vote_step_two").show();
				getResults();
			}
		});
	</script>
@endsection