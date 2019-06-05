@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-10 col-md-11 col-sm-12 col-12">
				<div class="gray-box">
					<div class="form-group">
						<h3 class="mb-8">Create a Task</h3>
						<p class="mb-1">Input the details about your task, then click on 'Create Task' to add it to your priority list.</p>
						<input type="checkbox" id="show_descriptions" class="mr-2">Show metric descriptions
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Task Title<span class="red">*</span></h5>
						<input type="text" class="form-control" id="title">
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Description of Task</h5>
						<textarea class="form-control" rows="4" id="description"></textarea>
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Reach<span class="red">*</span></h5>
						<p class="description" style="display: none;">How many customers, leads, or users will this task affect over the quarter? For example, if you are running a very large campaign, you will most likely be getting more leads than a small campaign, so this metric aligns you with reaching high impact by forcing you to see where the biggest opportunities lie.</p>
						<input type="number" class="form-control" id="reach" placeholder="Reach score (ex. 100 or 2500)">
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Impact<span class="red">*</span></h5>
						<p class="description" style="display: none;">Often enough, we end up doing tasks that have no impact just because they seem fun and you're bored. This may satisfactory in the short-run, however, by continually performing low-impact tasks, you end up suffering in the long-run by never making any solid progress.</p>
						<p class="description" style="display: none;">However, estimating Impact with a number can be somewhat a shot in the dark, so we've made it easy for you by giving you a multiple choice. Tasks can have one of the followimg Impact levels: minimal, low, medium, high, or massive.</p>
						<p class="description" style="display: none;">For example, if you are creating a promotional piece for your company that you think will have a huge impact on getting more revenue, then you would label this task as either 'high' or 'massive' Impact.</p>
						<select id="impact" class="form-control">
							<option value="0.25">Minimal</option>
							<option value="0.5">Low</option>
							<option value="1">Medium</option>
							<option value="2">High</option>
							<option value="3">Massive</option>
						</select>
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Confidence<span class="red">*</span></h5>
						<p class="description" style="display: none;">This metric is all about how confident you are about the other three metrics. This gives you the ability to be data-driven. This can give you the edge you need in a world full of distractions.</p>
						<p class="description" style="display: none;">A task might seem as if it has high reach, high impact, and low ease of effort, however, if you are making these claims from a gut-feeling, then your confidence level would be 'low' because you have not data to back it up with.</p>
						<p class="description" style="display: none;">However, if you had data that supports how much your reach will be, how impactful it will be, and how easy the task will be, then you have solid evidence backing up your estimates and you would rate your task as 'High' confidence.</p>
						<select id="confidence" class="form-control">
							<option value="0.5">Low</option>
							<option value="0.8">Medium</option>
							<option value="1">High</option>
						</select>
					</div>

					<div class="form-group">
						<hr />
						<h5 class="mb-16">Ease<span class="red">*</span></h5>
						<p class="description" style="display: none;">How easy do you think it will be to complete this task? Will it take 1 hour or will it take 120 hours? In a hyper-competitive world, we must strike a balance of speed and impact.</p>
						<p class="description" style="display: none;">If we are constantly doing very large tasks that may pay off well, the competitors may have gotten around to low-hanging fruit before you have, leaving your large task and effort at risk of failure.</p>
						<p class="description" style="display: none;">When thinking about this metric, think about how many hours it will take to complete the task.</p>
						<input type="number" class="form-control" id="ease" placeholder="Ease score (ex. 0.5 or 5)">
					</div>

					<div class="form-group">
						<p class="mobile-text-center red" id="error" style="display: none;">Please fill out all fields.</p>
						<button type="button" class="genric-btn primary rounded mobile-center-button create_task_button" style="font-size: 15px;">Create RICE Task</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-32">
			<div class="col-12">
				<table class="table table-striped" id="tasks">
					<thead>
						<tr>
							<th>Task Title</th>
							<th>Reach</th>
							<th>Impact</th>
							<th>Confidence</th>
							<th>Ease</th>
							<th>RICE Score</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if(count($tasks) > 0)
							@foreach($tasks as $task)
							<tr>
								<td>{{ $task->title }}</td>
								<td>{{ $task->reach }}</td>
								<td>{{ $task->impact }}</td>
								<td>{{ $task->confidence }}</td>
								<td>{{ $task->ease }}</td>
								<td>{{ $task->score }}</td>
								<td>
									<button id="{{ $task->id }}" class="mark_complete_button genric-btn info small" style="float: right; font-size: 13px;">Mark as Complete</button> 
									<button id="{{ $task->id }}" class="delete_task_button genric-btn danger small" style='float: right; font-size: 13px;'>Delete Task</button>
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		function validateFields() {
			if ($("#title").val() == "") {
				return false;
			}

			if ($("#reach").val() == "") {
				return false;
			}

			if ($("#ease").val() == "") {
				return false;
			}

			return true;	
		}

		$("#show_descriptions").on('change', function() {
			if ($(this).is(':checked') == true) {
				$(".description").fadeIn();
			} else {
				$(".description").fadeOut();
			}
		});

		$(".create_task_button").on('click', function() {
			if (validateFields() == false) {
				$("#error").show();
			} else {
				$("#error").hide();

				var title = $("#title").val();
				var description = $("#description").html();
				var reach = $("#reach").val();
				var impact = $("#impact").val();
				var confidence = $("#confidence").val();
				var ease = $("#ease").val();
				var rice_score = (reach * impact * confidence) / ease;

				var html = "<tr><td style='vertical-align: middle;'>" + title + "</td><td style='vertical-align: middle;'>" + reach + "</td><td style='vertical-align: middle;'>" + impact + "</td><td style='vertical-align: middle;'>" + confidence + "</td><td style='vertical-align: middle;'>" + ease + "</td><td style='vertical-align: middle;'>" + rice_score.toFixed(2) + "</td><td style='vertical-align: middle;'><button class='mark_complete_button genric-btn info small m-2' style='float: right; font-size: 13px;'>Mark as Complete</button> <button class='delete_task_button genric-btn danger small m-2' style='float: right; font-size: 13px;'>Delete Task</button></td></tr>";

				$("#tasks > tbody").append(html);
			}
		});
	</script>
@endsection