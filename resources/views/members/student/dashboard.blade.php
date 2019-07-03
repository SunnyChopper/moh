@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($classes) > 0)
				<div class="col-lg-8 col-md-8 col-sm-12 col-12">
					<h4>Your Classes</h4>
					<ul class="list-group mt-16">
						@foreach($classes as $class)
						<li class="list-group-item">
							<div class="row" style="display: flex;">
								<div class="col-lg-8 col-md-8 col-sm-12 col-12">
									<h5 class="mb-2">{{ $class->title }}</h5>
									<p class="mb-1">{{ $class->description }}</p>
									<p class="mb-0"><b>Category: </b> {{ $class->category }}</p>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin: auto;">
									<button id="class_{{ $class->id }}" class="delete_class_button genric-btn danger rounded small mt-16-mobile" style="font-size: 12px;">Delete Class and Tasks</button>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
					<div class="gray-box">
						<h4 class="text-center">Quick Actions</h4>
						<hr />
						<a href="{{ url('/members/student/class/new') }}" class="genric-btn info rounded centered small mt-16 mb-16" style="font-size: 13px;">Create New Class</a>
						<a href="{{ url('/members/student/tasks/new') }}" class="genric-btn info rounded centered small mt-16 mb-0" style="font-size: 13px;">Create New Task</a>
					</div>
				</div>
			@else
				<div class="col-lg-8 col-md-8 col-sm-12 col-12">
					<div class="gray-box">
						<h3 class="text-center mb-2">No Classes</h3>
						<p class="text-center black">Get started by creating your first class! This will allow you to organize your tasks better!</p>
						<a href="{{ url('/members/student/class/new') }}" class="genric-btn primary rounded centered" style="font-size: 14px;">Create New Class</a>
					</div>
				</div>
			@endif
		</div>
	</div>

	@if(count($classes) > 0)
	<div style="background: #EAEAEA;">
		<div class="container pt-64 pb-64">
			<div class="row justify-content-center">
				@if(count($tasks) > 0)
					<div class="col-12 mb-16">
						<h3 class="text-center">Your Upcoming Tasks</h3>
					</div>

					@foreach($tasks as $task)
					<div class="col-lg-4 col-md-4 col-sm-6 col-12 task-box" data-class="{{ $task->class_id }}">
						<div style="padding: 16px; background: white; border-radius: 8px;" class="mt-16 mt-16">
							<h4 class="mb-2">{{ $task->title }}</h4>
							@if($task->description != "" || $task->description != NULL)
							<p class="mb-1">{{ $task->description }}</p>
							@else
							<p class="mb-1">No description.</p>
							@endif
							<hr />

							@if($task->grade_impact == 0.5)
							<p class="mb-1"><b>Grade Impact: </b>Super Low</p>
							@elseif($task->grade_impact == 1)
							<p class="mb-1"><b>Grade Impact: </b>Low</p>
							@elseif($task->grade_impact == 2)
							<p class="mb-1"><b>Grade Impact: </b>Medium</p>
							@elseif($task->grade_impact == 3)
							<p class="mb-1"><b>Grade Impact: </b>High</p>
							@elseif($task->grade_impact == 4)
							<p class="mb-1"><b>Grade Impact: </b>Super High</p>
							@endif

							@if($task->confidence == 4)
							<p class="mb-1"><b>Confidence: </b>Super Low</p>
							@elseif($task->confidence == 3)
							<p class="mb-1"><b>Confidence: </b>Low</p>
							@elseif($task->confidence == 2)
							<p class="mb-1"><b>Confidence: </b>Medium</p>
							@elseif($task->confidence == 1)
							<p class="mb-1"><b>Confidence: </b>High</p>
							@elseif($task->confidence == 0.5)
							<p class="mb-1"><b>Confidence: </b>Super High</p>
							@endif

							@if($task->ease == 4)
							<p class="mb-1"><b>Ease: </b>Super Easy</p>
							@elseif($task->ease == 3)
							<p class="mb-1"><b>Ease: </b>Easy</p>
							@elseif($task->ease == 2)
							<p class="mb-1"><b>Ease: </b>Eh...</p>
							@elseif($task->ease == 1)
							<p class="mb-1"><b>Ease: </b>Hard</p>
							@elseif($task->ease == 0.5)
							<p class="mb-1"><b>Ease: </b>Super Hard</p>
							@endif

							<p class="mb-1"><b>Due Date: </b> {{ Carbon\Carbon::parse($task->due_date)->format('M jS, Y') }}</p>

							<?php
								$due_date = Carbon\Carbon::parse($task->due_date);
								$today = Carbon\Carbon::today();
								$diff = $due_date->diffInDays($today);
								if ($diff == 0) {
									$score = ((float)$task->grade_impact * (float)$task->confidence * (float)$task->ease) / (0.1);
								} else {
									$score = ((float)$task->grade_impact * (float)$task->confidence * (float)$task->ease) / ((float)$diff);
								}
							?>
							<p class="mb-1"><b>Days Left: </b> <?php echo $due_date->diffInDays($today); ?></p>
							<p class="mb-16"><b>Priority Score: </b> {{ $score }}</p>
							<button id="{{ $task->id }}" class="delete_task_button genric-btn danger small" style="font-size: 12px;">Delete Task</button>
							<button id="{{ $task->id }}" class="mark_complete_button genric-btn info small" style="font-size: 12px;">Mark as Complete</button>
						</div>
					</div>
					@endforeach
				@else
					<div class="col-lg-7 col-md-8 col-sm-12 col-12">
						<h3 class="text-center mb-2">No Tasks</h3>
						<p class="text-center">Hooray! There are no tasks left for you! Click below to create a task!</p>
						<a href="{{ url('/members/student/tasks/new') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">Create Task</a>
					</div>
				@endif
			</div>
		</div>
	</div>
	@endif

	{{-- <div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-7 col-sm-12 col-12">
				<h3 class="text-center mb-3">Something Not Working?</h3>
				<p class="text-center mb-32">We test all of the products before we release them, however, technology is never perfect. If something isn't working with the student planner, fill out the form below and our web dev team will be all over it.</p>


				<div class="form-group">
					<label>Name:</label>
					<input type="text" class="form-control" name="name">
				</div>

				<div class="form-group">
					<label>Email:</label>
					<input type="email" class="form-control" name="email">
				</div>

				<div class="form-group">
					<label>Message:</label>
					<textarea class="form-control" name="message" rows="5"></textarea>
				</div>

				<div class="form-group mt-32">
					<input type="submit" class="genric-btn info centered rounded" value="Submit Support Ticket" style="font-size: 15px;">
				</div>

			</div>
		</div>
	</div> --}}
@endsection

@section('page_js')
	<script type="text/javascript">
		$(".delete_class_button").on('click', function() {
			var button = $(this);
			var class_id = $(this).attr('id').replace('class_', '');
			$.ajax({
				url : '/members/student/class/delete',
				type : 'POST',
				data : {
					'_token' : '{{ csrf_token() }}',
					'class_id' : class_id
				},
				success: function(data) {
					if ("success" in data) {
						var li = button.closest("li");
						li.remove();

						$('.task-box[data-class="' + class_id + '"]').remove();

						location.reload();
					}
				}
			});
		});

		$(".delete_task_button").on('click', function() {
			var button = $(this);
			var task_id = button.attr('id');
			$.ajax({
				url : '/members/student/tasks/delete',
				type : 'POST',
				data : {
					'_token' : '{{ csrf_token() }}',
					'task_id' : task_id
				},
				success: function(data) {
					if ("success" in data) {
						var box = button.closest(".task-box");
						box.remove();
					}
				}
			});
		});

		$(".mark_complete_button").on('click', function() {
			var button = $(this);
			var task_id = button.attr('id');
			$.ajax({
				url : '/members/student/tasks/complete',
				type : 'POST',
				data : {
					'_token' : '{{ csrf_token() }}',
					'task_id' : task_id
				},
				success: function(data) {
					if ("success" in data) {
						var box = button.closest(".task-box");
						box.fadeOut();
					}
				}
			});
		});
	</script>
@endsection