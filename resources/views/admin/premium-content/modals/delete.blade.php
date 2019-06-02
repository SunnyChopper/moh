<div class="modal fade" id="delete_premium_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="/admin/premium/delete" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="premium_content_id" id="delete_premium_content_id">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Are you sure?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
							<p>Are you sure that you want to delete this premium content?</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</div>
		</form>
	</div>
</div>