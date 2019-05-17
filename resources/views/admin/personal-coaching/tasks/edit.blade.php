@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_task_form" action="/admin/personal-coaching/tasks/update" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="mentee_id" value="{{ $mentee_id }}">
						<input type="hidden" name="task_id" value="{{ $task->id }}">

						<div class="form-group">
							<h5 class="mb-2">Title<span class="red">*</span>:</h5>
							<input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Description<span class="red">*</span>:</h5>
							<textarea form="update_task_form" name="description" class="form-control" rows="5">{{ $task->description }}</textarea>
						</div>

						<div class="form-group">
							<h5 class="mb-2">Due Date<span class="red">*</span>:</h5>
							<input type="date" name="due_date" class="form-control" value="{{ Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}" required>
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