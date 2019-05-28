<div class="modal fade" id="view_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="update_consultation_form" action="/admin/personal-coaching/consultations/update" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="consultation_id" id="update_consultation_id">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Free Consultation Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<p class="mb-1"><b>First Name:</b> <span id="first_name"></span></p>
							<p class="mb-1"><b>Last Name:</b> <span id="last_name"></span></p>
							<p class="mb-0"><b>Skype ID:</b> <span id="skype_id"></span></p>
							<hr />
							<p class="mb-1"><b>Self-Awareness:</b> <span id="sa_percentage"></span></p>
							<p class="mb-1"><b>Focus:</b> <span id="f_percentage"></span></p>
							<p class="mb-1"><b>Self-Discipline:</b> <span id="sd_percentage"></span></p>
							<p class="mb-1"><b>Habits:</b> <span id="ha_percentage"></span></p>
							<p class="mb-1"><b>Health:</b> <span id="he_percentage"></span></p>
							<p class="mb-0"><b>Self-Fulfillment:</b> <span id="sf_percentage"></span></p>
							<hr />
							<div class="form-group row">
								<div class="col-lg-6 col-md-6 col-sm-8 col-12">
									<label>Status:</label>
									<select name="status" class="form-control" form="update_consultation_form">
										<option value="0">Open</option>
										<option value="1">Contacted</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="genric-btn primary rounded" value="Update">
				</div>
			</div>
		</form>
	</div>
</div>