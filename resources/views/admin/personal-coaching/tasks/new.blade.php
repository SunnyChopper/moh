@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="create_task_form" action="/admin/personal-coaching/tasks/create" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" name="title" class="form-control" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea form="create_task_form" name="description" class="form-control" rows="5"></textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Due Date<span class="red">*</span>:</h5>
							<input type="date" name="due_date" class="form-control" required>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary centered rounded mt-32" value="Assign Task">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection