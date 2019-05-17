@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($mentees) > 0)
			<div class="col-12">
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($mentees as $m)
							<tr>
								<td>{{ $m->first_name }} {{ $m->last_name }}</td>
								<td>{{ $m->email }}</td>
								<td>
									<a href="{{ url('/admin/personal-coaching/mentee/' . $m->id) }}" class="genric-btn primary rounded small" style="float: right;">Manage</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@else
			<div class="col-lg-6 col-md-7 col-sm-10 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Mentees</h3>
					<p class="text-center mb-0">There are currently no mentees in the system.</p>
				</div>
			</div>
			@endif
		</div>
	</div>
@endsection