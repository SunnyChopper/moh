@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.book-club.votes.modals.create')
	@include('admin.book-club.votes.modals.edit')
	@include('admin.book-club.votes.modals.delete')

	<div class='container pt-64 pb-64'>
		<div id='view' class='row justify-content-center'>
			
		</div>
	</div>
@endsection

@section('page_js')
	<script type='text/javascript'>
		var _token = '{{ csrf_token() }}';
		var polls = Array();

		function displayEmptyView() {
			var html = `
				<div class='col-lg-7 col-md-9 col-sm-11 col-12'>
					<div class='gray-box'>
						<h3 class='text-center mb-2'>No Active Polls</h3>
						<p class='text-center'>There are no active polls on the site right now. Click below to create the first poll.</p>
						<button type='button' class='genric-btn primary centered rounded new_poll_button' style='font-size: 14px;'>Create New Poll</button>
					</div>
				</div>
			`;

			$("#view").html(html);
		}

		function displayTableView() {
			var table_html = `
				<div class='col-lg-9 col-md-9 col-sm-12 col-12'>
					<div style='overflow: auto;'>
						<table class='table table-striped' style='min-width: 500px;'>
							<thead>
								<tr>
									<th style="min-width: 115px;">Start Date</th>
									<th style="min-width: 115px;">End Date</th>
									<th style="min-width: 150px;">Book 1</th>
									<th style="min-width: 150px;">Book 2</th>
									<th style="min-width: 150px;">Book 3</th>
									<th style="min-width: 150px;">Book 4</th>
									<th style="min-width: 250px;"></th>
								</tr>
							</thead>
							<tbody>`;

			polls.forEach(function(poll) {
				table_html += `
					<tr>
						<td style="vertical-align: middle;">` + poll["start_date"] + `</td>
						<td style="vertical-align: middle;">` + poll["end_date"] + `</td>
						<td style="vertical-align: middle;">` + poll["book_1_title"] + `</td>
						<td style="vertical-align: middle;">` + poll["book_2_title"] + `</td>
						<td style="vertical-align: middle;">` + poll["book_3_title"] + `</td>
						<td style="vertical-align: middle;">` + poll["book_4_title"] + `</td>
						<td style="vertical-align: middle;">
							<button type="button" data-id="` + poll["id"] + `" class="genric-btn small danger delete_poll_button m-1" style="float: right;">Delete</button>
							<button type="button" data-id="` + poll["id"] + `" class="genric-btn small info edit_poll_button m-1" style="float: right;">Edit</button>
						</td>
					</tr>
				`;
			});

			table_html +=	`</tbody>
						</table>
					</div>
				</div>
				<div class='col-lg-3 col-md-3 col-sm-12 col-12 mt-16-mobile'>
					<div class='gray-box'>
						<h4 class='text-center mb-3'>Quick Actions</h4>
						<button type='button' class='genric-btn primary full-width rounded new_poll_button' style='font-size: 14px;'>Create New Poll</button>
					</div>
				</div>
			`;

			$("#view").html(table_html);
		}

		function updateUI() {
			if (polls.length > 0) {
				displayTableView();
			} else {
				displayEmptyView();
			}
		}

		function getPolls() {
			$.ajax({
				url : '/api/book-club/polls',
				type : 'GET',
				success : function(data) {
					polls = data;
					updateUI();
				}
			});
		}

		$(".create").on('click', function() {
			var book_1_title = $("#create_book_1_title").val();
			var book_1_image_url = $("#create_book_1_image_url").val();
			var book_2_title = $("#create_book_2_title").val();
			var book_2_image_url = $("#create_book_2_image_url").val();
			var book_3_title = $("#create_book_3_title").val();
			var book_3_image_url = $("#create_book_3_image_url").val();
			var book_4_title = $("#create_book_4_title").val();
			var book_4_image_url = $("#create_book_4_image_url").val();
			var start_date = $("#create_start_date").val();
			var end_date = $("#create_end_date").val();

			if (book_1_title != "" && book_1_image_url != "" && book_2_title != "" && book_2_image_url != "" && book_3_title != "" && book_3_image_url != "" && book_4_title != "" && book_4_image_url != "" && start_date != "" && end_date != "") {
				$.ajax({
					url : '/api/book-club/polls/create',
					type : 'POST',
					data : {
						'_token' : _token,
						'book_1_title' : book_1_title,
						'book_1_amazon_url' : $("#create_book_1_amazon").val(),
						'book_1_image_url' : book_1_image_url,
						'book_1_description' : $("#create_book_1_description").val(),
						'book_2_title' : book_2_title,
						'book_2_amazon_url' : $("#create_book_2_amazon").val(),
						'book_2_image_url' : book_2_image_url,
						'book_2_description' : $("#create_book_2_description").val(),
						'book_3_title' : book_3_title,
						'book_3_amazon_url' : $("#create_book_3_amazon").val(),
						'book_3_image_url' : book_3_image_url,
						'book_3_description' : $("#create_book_3_description").val(),
						'book_4_title' : book_4_title,
						'book_4_amazon_url' : $("#create_book_4_amazon").val(),
						'book_4_image_url' : book_4_image_url,
						'book_4_description' : $("#create_book_4_description").val(),
						'start_date' : start_date,
						'end_date' : end_date
					},
					success : function(data) {
						if (data == true) {
							$("#create_start_date").val('');
							$("#create_end_date").val('');
							$("#create_book_1_title").val('');
							$("#create_book_1_amazon").val('');
							$("#create_book_1_image_url").val('');
							$("#create_book_1_description").val('');
							$("#create_book_2_title").val('');
							$("#create_book_2_amazon").val('');
							$("#create_book_2_image_url").val('');
							$("#create_book_2_description").val('');
							$("#create_book_3_title").val('');
							$("#create_book_3_amazon").val('');
							$("#create_book_3_image_url").val('');
							$("#create_book_3_description").val('');
							$("#create_book_4_title").val('');
							$("#create_book_4_amazon").val('');
							$("#create_book_4_image_url").val('');
							$("#create_book_4_description").val('');
							$("#new_poll_modal").modal('hide');

							getPolls();
						}
					}
				});
			} else {
				$("#create_feedback").html('Please fill out all required fields.');
				$("#create_feedback").show();
			}
		});

		$(".update").on('click', function() {
			var book_1_title = $("#edit_book_1_title").val();
			var book_1_image_url = $("#edit_book_1_image_url").val();
			var book_2_title = $("#edit_book_2_title").val();
			var book_2_image_url = $("#edit_book_2_image_url").val();
			var book_3_title = $("#edit_book_3_title").val();
			var book_3_image_url = $("#edit_book_3_image_url").val();
			var book_4_title = $("#edit_book_4_title").val();
			var book_4_image_url = $("#edit_book_4_image_url").val();
			var start_date = $("#edit_start_date").val();
			var end_date = $("#edit_end_date").val();

			if (book_1_title != "" && book_1_image_url != "" && book_2_title != "" && book_2_image_url != "" && book_3_title != "" && book_3_image_url != "" && book_4_title != "" && book_4_image_url != "" && start_date != "" && end_date != "") {
				$.ajax({
					url : '/api/book-club/polls/update',
					type : 'POST',
					data : {
						'_token' : _token,
						'poll_id' : $("#edit_poll_id").val(),
						'book_1_title' : book_1_title,
						'book_1_amazon_url' : $("#edit_book_1_amazon").val(),
						'book_1_image_url' : book_1_image_url,
						'book_1_description' : $("#edit_book_1_description").val(),
						'book_2_title' : book_2_title,
						'book_2_amazon_url' : $("#edit_book_2_amazon").val(),
						'book_2_image_url' : book_2_image_url,
						'book_2_description' : $("#edit_book_2_description").val(),
						'book_3_title' : book_3_title,
						'book_3_amazon_url' : $("#edit_book_3_amazon").val(),
						'book_3_image_url' : book_3_image_url,
						'book_3_description' : $("#edit_book_3_description").val(),
						'book_4_title' : book_4_title,
						'book_4_amazon_url' : $("#edit_book_4_amazon").val(),
						'book_4_image_url' : book_4_image_url,
						'book_4_description' : $("#edit_book_4_description").val(),
						'start_date' : start_date,
						'end_date' : end_date
					},
					success : function(data) {
						if (data == true) {
							$("#edit_poll_modal").modal('hide');
							getPolls();
						}
					}
				});
			} else {
				$("#create_feedback").html('Please fill out all required fields.');
				$("#create_feedback").show();
			}
		});

		$(".delete").on('click', function() {
			$.ajax({
				url : '/api/book-club/polls/delete',
				type : 'POST',
				data : {
					'_token' : _token,
					'poll_id' : $("#delete_poll_id").val()
				},
				success : function(data) {
					if (data == true) {
						getPolls();
						$("#delete_poll_modal").modal('hide');
					}
				}
			});
		});

		$(document.body).on('click', '.new_poll_button', function() {
			$('#new_poll_modal').modal();
		});

		$(document.body).on('click', '.edit_poll_button', function() {
			var poll_id = $(this).data('id');

			polls.forEach(function(poll) {
				if (poll["id"] == poll_id) {
					$("#edit_poll_id").val(poll_id);
					$("#edit_start_date").val(poll["start_date"]);
					$("#edit_end_date").val(poll["end_date"]);
					$("#edit_book_1_title").val(poll["book_1_title"]);
					$("#edit_book_1_amazon").val(poll["book_1_amazon_url"]);
					$("#edit_book_1_image_url").val(poll["book_1_image_url"]);
					$("#edit_book_1_description").val(poll["book_1_description"]);
					$("#edit_book_2_title").val(poll["book_2_title"]);
					$("#edit_book_2_amazon").val(poll["book_2_amazon_url"]);
					$("#edit_book_2_image_url").val(poll["book_2_image_url"]);
					$("#edit_book_2_description").val(poll["book_2_description"]);
					$("#edit_book_3_title").val(poll["book_3_title"]);
					$("#edit_book_3_amazon").val(poll["book_3_amazon_url"]);
					$("#edit_book_3_image_url").val(poll["book_3_image_url"]);
					$("#edit_book_3_description").val(poll["book_3_description"]);
					$("#edit_book_4_title").val(poll["book_4_title"]);
					$("#edit_book_4_amazon").val(poll["book_4_amazon_url"]);
					$("#edit_book_4_image_url").val(poll["book_4_image_url"]);
					$("#edit_book_4_description").val(poll["book_4_description"]);
				}
			});

			$("#edit_poll_modal").modal();
		});

		$(document.body).on('click', '.delete_poll_button', function() {
			var poll_id = $(this).data('id');
			$("#delete_poll_id").val(poll_id);
			$('#delete_poll_modal').modal();
		});

		$(document).ready(function() {
			getPolls();
		});
	</script>
@endsection