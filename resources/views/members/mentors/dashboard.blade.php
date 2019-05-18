@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12 col-12 mb-32-mobile">
				<h3 class="mb-16">Appointments</h3>
				@if(count($appointments) > 0)
				@else
				<p>You do not have any appointments scheduled. Click below to see available listings.</p>
				<a href="{{ url('/members/personal-coaching/appointments') }}" class="genric-btn primary rounded">Check Appointments</a>
				@endif
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12 col-12">
				<div class="gray-box">
					<h4 class="text-center mb-16">Contact Options</h4>
					<h6 class="text-center mb-3"><i class="fa fa-instagram mr-2"></i><strong>Instagram: </strong> {INSERT_INSTA_USERNAME}</h6>
					<h6 class="text-center mb-3"><i class="fa fa-twitter mr-2"></i><strong>Twitter: </strong> {INSERT_TWITTER_USERNAME}</h6>
					<h6 class="text-center mb-0"><i class="fa fa-envelope mr-2"></i><strong>Email: </strong> <a href="mailto:info@mindofhabit.com">info@mindofhabit.com</a></h6>
				</div>
			</div>
		</div>
	</div>

	<div style="background-color: #F4F4F4;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<h3 class="mb-16">Documents</h3>
					@if(count($documents) > 0)
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
								<td style="vertical-align: middle;">{{ $d->title }}</td>
								<td style="vertical-align: middle;">{{ $d->created_at->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;"><a href="{{ $d->link }}" target="_blank" class="genric-btn primary rounded small" style="float: right;">Access</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<hr />
					<p>There are no documents shared with you at the moment.</p>
					@endif
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<h3 class="mb-16">Recommendations</h3>
					@if(count($recommendations) > 0)
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Type</th>
								<th>Date Shared</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($recommendations as $r)
							<tr>
								<td style="vertical-align: middle;">{{ $r->title }}</td>
								<td style="vertical-align: middle;">
									@if($r->type == 1)
									Article
									@elseif($r->type == 2)
									Video
									@elseif($r->type == 3)
									Book
									@elseif($r->type == 4)
									Movie
									@else
									URL Link
									@endif
								</td>
								<td style="vertical-align: middle;">{{ $r->created_at->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;"><a href="{{ $r->link }}" target="_blank" class="genric-btn primary rounded small" style="float: right;">Access</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<hr />
					<p>There are no recommendations shared with you at the moment.</p>
					@endif
				</div>
			</div>

			<div class="row mt-32">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<h3 class="mb-16">Tasks</h3>
					@if(count($tasks) > 0)
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
								<td style="vertical-align: middle;">{{ $t->title }}</td>
								<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($t->due_date)->format('M jS, Y') }}</td>
								<td>
									@if($t->status == 1)
									Not Started
									@elseif($t->status == 2)
									In Progress
									@else
									Done
									@endif
								</td>
								<td style="vertical-align: middle;"><a href="{{ url('/members/personal-coaching/tasks/' . $t->id . '/edit') }}" class="genric-btn info rounded small" style="float: right;">Update Task</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<hr />
					<p>There are no documents shared with you at the moment.</p>
					@endif
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<h3 class="mb-16">Videos</h3>
					@if(count($videos) > 0)
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Created On</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($videos as $v)
							<tr>
								<td style="vertical-align: middle;">{{ $v->title }}</td>
								<td style="vertical-align: middle;">{{ Carbon\Carbon::parse($v->due_date)->format('M jS, Y') }}</td>
								<td style="vertical-align: middle;"><a href="{{ url('https://www.youtube.com/watch?v=' . $v->video_id) }}" target="_blank" class="genric-btn primary rounded small" style="float: right;">Watch Video</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<hr />
					<p>There are no documents shared with you at the moment.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection