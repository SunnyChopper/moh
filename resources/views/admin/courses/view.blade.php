@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($courses) > 0)
			<div class="col-12">

				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Price</th>
								<th>Number of Users</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($courses as $c)
							<tr>
								<td style="width: 15%; vertical-align: middle;">{{ $c->title }}</td>
								<td style="width: 25%; vertical-align: middle;">{{ $c->description }}</td>
								<td style="width: 10%; vertical-align: middle;">${{ sprintf("%.2f", $c->price) }}</td>
								<td style="width: 15%; vertical-align: middle;">{{ App\Custom\CourseHelper::getNumMembers($c->id) }}</td>
								<td style="width: 35%; vertical-align: middle;">
									<a href="{{ url('/admin/courses/' . $c->id . 'content/') }}" class="genric-btn primary small m-1" style="float: right;">Edit Content</a>
									<a href="{{ url('/admin/courses/edit/' . $c->id) }}" class="genric-btn info small m-1" style="float: right;">Edit</a>
									<button class="genric-btn danger small m-1" style="float: right;">Delete</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<a href="/admin/courses/new" class="primary-btn centered mt-32">Create New Course</a>
			</div>
			@else
			<div class="col-lg-5 col-md-6 col-sm-10 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Courses</h3>
					<p class="text-center">There are no courses in the system. Click below to create the first one.</p>
					<a href="{{ url('/admin/courses/new') }}" class="primary-btn rounded centered">Create New Course</a>
				</div>
			</div>
			@endif
		</div>
	</div>
@endsection