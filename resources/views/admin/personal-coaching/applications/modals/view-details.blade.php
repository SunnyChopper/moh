<div class="modal fade" id="view_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Personal Coaching Application Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="update_application_id">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<p class="mb-1"><b>First name:</b> <span id="first_name"></span></p>
						<p class="mb-1"><b>Last name:</b> <span id="last_name"></span></p>
						<p class="mb-1"><b>Email:</b> <span id="email"></span></p>
						<p class="mb-0"><b>Phone:</b> <span id="phone"></span></p>
						<hr />
						<p class="mb-1"><b>Preferred call time:</b> <span id="phone"></span></p>
						<p class="mb-0"><b>Timezone:</b> <span id="timezone"></span></p>
						<hr />
						<p class="mb-1"><b>Number of years in self development (0 - 10):</b> <span id="years"></span></p>
						<p class="mb-1"><b>How determined to improve (1 - 5):</b> <span id="determination_score"></span></p>
						<p class="mb-1"><b>What are your strengths:</b> <span id="strengths"></span></p>
						<p class="mb-1"><b>What are your weaknesses:</b> <span id="weaknesses"></span></p>
						<p class="mb-1"><b>Why should we pick them:</b> <span id="why"></span></p>
						<p class="mb-0"><b>Why they started in self development:</b> <span id="purpose"></span></p>
						<hr />
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-8 col-12">
								<label>Status:</label>
								<select id="update_status" class="form-control">
									<option value="0">Delete</option>
									<option value="1" selected>Active</option>
									<option value="2">Contacted</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="genric-btn primary rounded update" style="font-size: 16px;">Update</button>
			</div>
		</div>
	</div>
</div>