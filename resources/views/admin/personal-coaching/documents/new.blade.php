@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="create_document_form" action="/admin/personal-coaching/documents/create" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" class="form-control" name="title" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea class="form-control" rows="5" name="description" form="create_document_form"></textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">URL Link<span class="red">*</span>:</h5>
							<input type="url" class="form-control" name="link" required>
						</div>

						<div class="form-group mt-32">
							<input type="submit" class="genric-btn primary centered rounded" value="Share Document">
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection