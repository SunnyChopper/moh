@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.personal-coaching.applications.modals.view-details')

	<div class='container pt-64 pb-64'>
		<div id='view' class='row justify-content-center'>
			
		</div>
	</div>
@endsection

@section('page_js')
	<script type='text/javascript'>
		var _token = '{{ csrf_token() }}';
		var selected_application = null;
		var applications = Array();

		function displayTableView() {
			var table_html = `
				<div class='col-12'>
					<div style='overflow: auto;'>
						<table class='table table-striped'>
							<thead>
								<tr>
									<th>Date Submitted</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Timezone</th>
									<th></th>
								</tr>
							</thead>
							<tbody>`;

			applications.forEach(function(application) {
				table_html += `
					<tr>
						<td style="vertical-align: middle;">` + application["created_at"] + `</td>
						<td style="vertical-align: middle;">` + application["first_name"] + `</td>`;

				if (application["last_name"] == null) {
					table_html += `<td style="vertical-align: middle;">N/A</td>`;
				} else {
					table_html += `<td style="vertical-align: middle;">` + application["last_name"] + `</td>`;
				}
				
				table_html += `<td style="vertical-align: middle;">` + application["email"] + `</td>
						<td style="vertical-align: middle;">` + application["phone"] + `</td>
						<td style="vertical-align: middle;">` + application["timezone"] + `</td>
						<td style="vertical-align: middle;">
							<button class='genric-btn primary small view_details' data-id="` + application["id"] + `" style='float: right;'>View Details</button>
						</td>
					</tr>
				`;
 			});

			table_html +=	`</tbody>
						</table>
					</div>
				</div>
			`;

			$('#view').html(table_html);
		}

		function displayEmptyView() {
			var empty_html = `
				<div class='col-lg-7 col-md-8 col-sm-12 col-12'>
					<div class='gray-box'>
						<h3 class='text-center mb-2'>No Applications Found</h3>
						<p class='text-center mb-0'>There were no active applications in the database.</p>
					</div>
				</div>
			`;

			$('#view').html(empty_html);
		}

		function updateUI() {
			if (applications.length > 0) {
				displayTableView();
			} else {
				displayEmptyView();
			}
		}

		function fetchData() {
			$.ajax({
				url : '/api/personal-coaching/applications',
				type : 'GET',
				success : function(data) {
					applications = data;
					updateUI();
				}
			});
		}

		$(".update").on('click', function() {
			var application_id = $("#update_application_id").val();
			$.ajax({
				url : '/api/personal-coaching/applications/update',
				type : 'POST',
				data : {
					'_token' : _token,
					'application_id' : application_id,
					'status' : $('#update_status').val()
				},
				success : function(data) {
					if (data == true) {
						$('#update_status').val("1");
						$('#view_details_modal').modal('hide');
						fetchData();
					}
				}
			});
		});

		$(document.body).on('click', '.view_details', function() {
			var application_id = $(this).data('id');
			applications.forEach(function(app) {
				if (app["id"] == application_id) {
					selected_application = app;
				}
			});

			$('#first_name').html(selected_application["first_name"]);
			$('#last_name').html(selected_application["last_name"]);
			$('#email').html(selected_application["email"]);
			$('#phone').html(selected_application["phone"]);
			$('#call_time').html(selected_application["call_time"]);
			$('#timezone').html(selected_application["timezone"]);
			$('#years').html(selected_application["years"]);
			$('#determination_score').html(selected_application["determination_score"]);
			$('#strengths').html(selected_application["strengths"]);
			$('#weaknesses').html(selected_application["weaknesses"]);
			$('#why').html(selected_application["why"]);
			$('#purpose').html(selected_application["purpose"]);
			$('#update_application_id').val(selected_application["id"]);

			$('#view_details_modal').modal();
		});

		$(document).ready(function() {
			fetchData();
		});
	</script>
@endsection