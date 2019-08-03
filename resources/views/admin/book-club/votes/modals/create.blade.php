<div class="modal fade" id="new_poll_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create New Voting Poll</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="mb-3">Fields with <span class="red">*</span> are required.</p>
				<div class="gray-box mb-2">
					<h4>Book 1</h4>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Title:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_1_title">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Amazon URL:</label>
							<input type="text" class="form-control" id="create_book_1_amazon">
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
							<label>Image URL:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_1_image_url">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Description:</label>
							<textarea class="form-control" rows="4" id="create_book_1_description"></textarea>
						</div>
					</div>
				</div>

				<div class="gray-box mt-4">
					<h4>Book 2</h4>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Title:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_2_title">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Amazon URL:</label>
							<input type="text" class="form-control" id="create_book_2_amazon">
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
							<label>Image URL:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_2_image_url">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Description:</label>
							<textarea class="form-control" rows="4" id="create_book_2_description"></textarea>
						</div>
					</div>
				</div>

				<div class="gray-box mt-4">
					<h4>Book 3</h4>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Title:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_3_title">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Amazon URL:</label>
							<input type="text" class="form-control" id="create_book_3_amazon">
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
							<label>Image URL:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_3_image_url">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Description:</label>
							<textarea class="form-control" rows="4" id="create_book_3_description"></textarea>
						</div>
					</div>
				</div>

				<div class="gray-box mt-4">
					<h4>Book 4</h4>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Title:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_4_title">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							<label>Amazon URL:</label>
							<input type="text" class="form-control" id="create_book_4_amazon">
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
							<label>Image URL:<span class="red">*</span></label>
							<input type="text" class="form-control" id="create_book_4_image_url">
						</div>
					</div>

					<div class="form-group row mt-16">
						<div class="col-12">
							<label>Description:</label>
							<textarea class="form-control" rows="4" id="create_book_4_description"></textarea>
						</div>
					</div>
				</div>

				<div class="form-group row mt-3">
					<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						<label>Start Date:<span class="red">*</span></label>
						<input type="date" class="form-control" id="create_start_date">
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
						<label>End Date:<span class="red">*</span></label>
						<input type="date" class="form-control" id="create_end_date">
					</div>
				</div>

				<p class="text-center red" id="create_feedback" style="display: none"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success create" value="Create">
			</div>
		</div>
	</div>
</div>