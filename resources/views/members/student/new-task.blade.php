@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center">Create New Task</h3>
					<p class="text-center black">Fields with <span class="red">*</span> are required.</p>
					<form id="create_task_form" action="/members/student/tasks/create" method="POST">
						{{ csrf_field() }}
						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Title<span class="red">*</span>:</h5>
								<input type="text" class="form-control" name="title" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Description:</h5>
								<textarea class="form-control" name="description" rows="4" form="create_task_form"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Class<span class="red">*</span>:</h5>
								<select name="class_id" class="form-control" form="create_task_form">
									@foreach($classes as $class)
									<option value="{{ $class->id }}">{{ $class->title }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Category<span class="red">*</span>:</h5>
								<select name="category" class="form-control" form="create_task_form">
									<option value="Homework">Homework</option>
									<option value="Quiz">Quiz</option>
									<option value="Project">Project</option>
									<option value="Discussion">Discussion</option>
									<option value="Midterm">Midterm</option>
									<option value="Final Exam">Final Exam</option>
								</select>
							</div>
						</div>

						<div class="form-group row mt-32">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<h5 class="mb-2">Grade Impact<span class="red">*</span>:</h5>
								<p>How much will this task impact your grade? For example, a small quiz does not impact your grade as much as a midterm or chapter exam.</p>
								<select form="create_task_form" name="grade_impact" class="form-control">
									<option value="0.5">Super Low</option>
									<option value="1">Low</option>
									<option value="2">Medium</option>
									<option value="3">High</option>
									<option value="4">Super High</option>
								</select>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<h5 class="mb-2">Confidence<span class="red">*</span>:</h5>
								<p>How confident are you that you can learn and complete this task? If you're not confident, it will be prioritized higher.</p>
								<select form="create_task_form" name="confidence" class="form-control">
									<option value="4">Super Low</option>
									<option value="3">Low</option>
									<option value="2">Medium</option>
									<option value="1">High</option>
									<option value="0.5">Super High</option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<h5 class="mb-2">Ease<span class="red">*</span>:</h5>
								<p>How easy will this task be? Generally, the easier the task is, you want to get it done first and get it out of the way.</p>
								<select form="create_task_form" name="ease" class="form-control">
									<option value="4">Super Easy</option>
									<option value="3">Easy</option>
									<option value="2">Eh...</option>
									<option value="1">Hard</option>
									<option value="0.5">Super Hard</option>
								</select>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<h5 class="mb-2">Due Date<span class="red">*</span>:</h5>
								<p>Something that is due soon will take higher priority than something that's due later. We'll calculate the days for you!</p>
								<input type="date" class="form-control" name="due_date" required>
							</div>
						</div>

						<div class="form-group mt-32">
							<input type="submit" class="genric-btn primary rounded centered" style="font-size: 14px;" value="Create Task">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection