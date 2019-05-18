@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.personal-coaching.modals.delete-document')
	@include('admin.personal-coaching.modals.delete-recommendation')
	@include('admin.personal-coaching.modals.delete-task')
	@include('admin.personal-coaching.modals.delete-video')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h3 class="mb-16">Appointments</h3>

				@if(count($appointments) > 0)

				@else
				<div class="gray-box">
					<h4 class="text-center mb-2">No Upcoming Appointments</h4>
					<p class="text-center mb-0">There are no upcoming appointments with this mentee.</p>
				</div>
				@endif

				<h3 class="mt-32 mb-16">Documents</h3>

				@if(count($documents) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Date Shared</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@foreach($documents as $d)
							<tr>
								<td style="vertical-align: middle;"><a href="{{ $d->link }}">{{ $d->title }}</a></td>
								<td style="vertical-align: middle;">{{ $d->created_at->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;">

									<button id="{{ $d->id }}" class="genric-btn danger rounded small delete_document_button" style="float: right;">Delete</button>
									<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/documents/' . $d->id . '/edit') }}" class="genric-btn info rounded small mr-2" style="float: right;">Edit</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="gray-box">
					<h4 class="text-center mb-2">No Documents Shared</h4>
					<p class="text-center">There are no documents being shared with this mentee. Click below to get started on sharing a Google Drive document.</p>
					<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/documents/new') }}" class="genric-btn primary rounded centered small">Create New Document</a>
				</div>
				@endif

				<h3 class="mt-32 mb-16">Recommendations</h3>

				@if(count($recommendations) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Date Created</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@foreach($recommendations as $r)
							<tr>
								<td style="vertical-align: middle;"><a href="{{ $r->link }}">{{ $r->title }}</a></td>
								<td style="vertical-align: middle;">{{ $r->created_at->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;">

									<button id="{{ $d->id }}" class="genric-btn danger rounded small delete_recommendation_button" style="float: right;">Delete</button>
									<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/recommendations/' . $d->id . '/edit') }}" class="genric-btn info rounded small mr-2" style="float: right;">Edit</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="gray-box">
					<h4 class="text-center mb-2">No Recommendations</h4>
					<p class="text-center">There are no recommendations for this mentee. Click below to get started on creating the first recommendation.</p>
					<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/recommendations/new') }}" class="genric-btn primary rounded centered small">Create New Recommendation</a>
				</div>
				@endif

				<h3 class="mt-32 mb-16">Assigned Tasks</h3>

				@if(count($tasks) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Due Date</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@foreach($tasks as $t)
							<tr>
								<td style="vertical-align: middle;">{{ $t->title }}	</td>
								<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($t->due_date)->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;">
									@if($t->status == 1)
									Not Started
									@elseif($t->status == 2)
									In Progress
									@elseif($t->status == 3)
									Waiting
									@elseif($t->status == 4)
									Need Help
									@else
									Done
									@endif
								</td>
								<td style="vertical-align: middle;">

									<button id="{{ $d->id }}" class="genric-btn danger rounded small delete_task_button" style="float: right;">Delete</button>
									<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/tasks/' . $d->id . '/edit') }}" class="genric-btn info rounded small mr-2" style="float: right;">Edit</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="gray-box">
					<h4 class="text-center mb-2">No Assigned Tasks</h4>
					<p class="text-center">There are no open tasks that are assigned to this mentee. Click below to get started on assigning a task.</p>
					<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/tasks/new') }}" class="genric-btn primary rounded centered small">Assign New Task</a>
				</div>
				@endif

				<h3 class="mt-32 mb-16">Videos</h3>

				@if(count($videos) > 0)
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Created At</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@foreach($videos as $v)
							<tr>
								<td style="vertical-align: middle;"><a href="{{ url('https://www.youtube.com/watch?v=' . $v->video_id) }}">{{ $v->title }}</a></td>
								<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($v->created_at)->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;">
									@if($v->status == 1)
									Not Viewed
									@elseif($v->status == 2)
									Viewed
									@endif
								</td>
								<td style="vertical-align: middle;">

									<button id="{{ $v->id }}" class="genric-btn danger rounded small delete_video_button" style="float: right;">Delete</button>
									<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/videos/' . $v->id . '/edit') }}" class="genric-btn info rounded small mr-2" style="float: right;">Edit</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="gray-box">
					<h4 class="text-center mb-2">No Videos</h4>
					<p class="text-center">There are no custom videos for this mentee. Click below to create a custom video for this mentee.</p>
					<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/videos/new') }}" class="genric-btn primary rounded centered small">Create New Video</a>
				</div>
				@endif
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<h5 class="text-center">Quick Actions</h5>
				<hr />

				<div class="gray-box">
					<ul class="list-group">
						<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/documents/new') }}">
							<li class="list-group-item">
								<h4>Share New Document <i class="fa fa-chevron-right" style="float: right; margin-top: 2px;"></i></h4>
							</li>
						</a>

						<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/recommendations/new') }}">
							<li class="list-group-item mt-16">
								<h4>New Recommendation <i class="fa fa-chevron-right" style="float: right; margin-top: 2px;"></i></h4>
							</li>
						</a>

						<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/tasks/new') }}">
							<li class="list-group-item mt-16">
								<h4>Assign Task <i class="fa fa-chevron-right" style="float: right; margin-top: 2px;"></i></h4>
							</li>
						</a>

						<a href="{{ url('/admin/personal-coaching/mentee/' . $mentee_id . '/videos/new') }}">
							<li class="list-group-item mt-16">
								<h4>Share Video <i class="fa fa-chevron-right" style="float: right; margin-top: 2px;"></i></h4>
							</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		$(".delete_document_button").on('click', function() {
			var id = $(this).attr('id');
			$("#delete_document_id").val(id);
			$("#delete_document_modal").modal();
		});

		$(".delete_recommendation_button").on('click', function() {
			var id = $(this).attr('id');
			$("#delete_recommendation_id").val(id);
			$("#delete_recommendation_modal").modal();
		});

		$(".delete_task_button").on('click', function() {
			var id = $(this).attr('id');
			$("#delete_task_id").val(id);
			$("#delete_task_modal").modal();
		});

		$(".delete_video_button").on('click', function() {
			var id = $(this).attr('id');
			$("#delete_video_id").val(id);
			$("#delete_video_modal").modal();
		});
	</script>
@endsection