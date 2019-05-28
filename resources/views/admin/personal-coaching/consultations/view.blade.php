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
									<th>Skype ID</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($consultations as $consultation)
								<tr>
									<td style="vertical-align: middle;">{{ $consultation->first_name }}</td>
									<td style="vertical-align: middle;">{{ $consultation->last_name }}</td>
									<td style="vertical-align: middle;">{{ $consultation->skype_id }}</td>
									<td style="vertical-align: middle;">
										<button id="{{ $consultation->id }}" class="genric-btn primary rounded small m-2 view_details_button" style="float: right;">View Details</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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