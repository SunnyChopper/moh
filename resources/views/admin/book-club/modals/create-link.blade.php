<div class="modal fade" id="create_link_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<input type="hidden" id="create_link_book_id" value="{{ $book->id }}">
				<h5 class="modal-title">Create New Link for {{ $book->title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="mb-3">Fields with <span class="red">*</span> are required.</p>
				<div class="form-group row">
					<div class="col-12">
						<h6 class="mb-1">Title:<span class="red">*</span></h6>
						<input type="text" id="create_link_title" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-12">
						<h6 class="mb-1">URL:<span class="red">*</span></h6>
						<input type="url" id="create_link_url" class="form-control">
					</div>
				</div>

				<p class="text-center red" id="create_link_error" style="display: none;"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success create_link" value="Create Link">
			</div>
		</div>
	</div>
</div>