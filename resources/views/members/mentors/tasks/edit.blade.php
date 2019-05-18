@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_task_form" action="/members/personal-coaching/tasks/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="task_id" value="{{ $task->id }}">

						<div class="form-group">
							<h5 class="mb-2">Title:</h5>
							<input type="text" disabled="true" value="{{ $task->title }}" class="form-control">
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description:</h5>
							<textarea class="form-control" disabled="true" rows="5">{{ $task->description }}</textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Due Date:</h5>
							<input type="date" disabled="true" value="{{ Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}" class="form-control">
						</div>

						<div class="form-group">
							<h5 class="mb-2">Status:</h5>
							<select name="status" class="form-control" form="update_task_form">
								<option value="1" <?php if ($task->status == 1) { echo "selected"; } ?>>Not Started</option>
								<option value="2" <?php if ($task->status == 2) { echo "selected"; } ?>>In Progress</option>
								<option value="3" <?php if ($task->status == 3) { echo "selected"; } ?>>Done</option>
							</select>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary centered rounded mt-32" value="Update Task">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection