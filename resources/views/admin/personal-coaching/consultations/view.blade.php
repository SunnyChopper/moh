@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.personal-coaching.consultations.modals.view-details')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($consultations) > 0)
				<div class="col-12">
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>App</th>
									<th>Username/Link</th>
									<th>Timezone</th>
									<th>Date</th>
									<th>Time</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($consultations as $consultation)
								<tr>
									<td style="vertical-align: middle;">{{ $consultation->first_name }}</td>
									<td style="vertical-align: middle;">{{ $consultation->last_name }}</td>

									@if($consultation->skype_id != "")
									<td style="vertical-align: middle;">{{ $consultation->skype_id }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									@if($consultation->app != "")
									<td style="vertical-align: middle;">{{ $consultation->app }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									@if($consultation->app != "")
										@if($consultation->app == "Instagram")
											<td style="vertical-align: middle;">{{ $consultation->contact }}</td>
										@elseif($consultation->app == "Skype")
											<td style="vertical-align: middle;">{{ $consultation->contact }}</td>
										@elseif($consultation->app == "Facebook Messenger")
											<td style="vertical-align: middle;"><a href="{{ $consultation->contact }}" class="genric-btn info rounded small">View Facebook</a></td>
										@elseif($consultation->app == "WhatsApp")
											<td style="vertical-align: middle;">{{ $consultation->contact }}</td>
										@elseif($consultation->app == "Telegram")
											<td style="vertical-align: middle;">{{ $consultation->contact }}</td>
										@endif
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									@if($consultation->timezone != "")
									<td style="vertical-align: middle;">{{ $consultation->timezone }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									@if($consultation->meeting_date != "")
									<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($consultation->meeting_date)->format('M jS, Y') }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									@if($consultation->meeting_time != "")
									<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($consultation->meeting_time)->format('h:i A') }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif

									<td style="vertical-align: middle;">
										<button id="{{ $consultation->id }}" class="genric-btn primary rounded small m-2 view_details_button" style="float: right;">View Details</button>

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						<a href="https://www.timeanddate.com/worldclock/converter.html" target="_blank" class="genric-btn info rounded small m-2">Convert Timezones</a>
					</div>
				</div>
			@else
				<div class="col-lg-7 col-md-8 col-sm-12 col-12">
					<div class="gray-box">
						<h3 class="text-center mb-2">No Open Consultations</h3>
						<p class="text-center mb-0">Hooray! There are no more open free consultations! Let's get some more leads now!</p>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		$(".view_details_button").on('click', function() {
			var id = $(this).attr('id');
			$.ajax({
				url : '/api/consultations/view',
				type : 'GET',
				data : {
					'consultation_id' : id
				},
				dataType : 'json',
				success: function(data) {
					$("#update_consultation_id").val(data["id"]);
					$("#first_name").html(data["first_name"]);
					$("#last_name").html(data["last_name"]);
					$("#skype_id").html(data["skype_id"]);
					$("#sa_percentage").html(data["sa_percentage"].toFixed(2) + "%");
					$("#f_percentage").html(data["f_percentage"].toFixed(2) + "%");
					$("#sd_percentage").html(data["sd_percentage"].toFixed(2) + "%");
					$("#ha_percentage").html(data["ha_percentage"].toFixed(2) + "%");
					$("#he_percentage").html(data["he_percentage"].toFixed(2) + "%");
					$("#sf_percentage").html(data["sf_percentage"].toFixed(2) + "%");
					$("#view_details_modal").modal();
				}
			});
		});
	</script>
@endsection