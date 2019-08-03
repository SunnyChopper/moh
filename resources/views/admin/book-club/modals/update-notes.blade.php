<div class="modal fade" id="update_notes_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<input type="hidden" id="update_notes_book_id">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Notes for {{ $book->title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<div class="col-12">
						<textarea id="book_notes" class="form-control" rows="15"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success update_notes" value="Update">
			</div>
		</div>
	</div>
</div>