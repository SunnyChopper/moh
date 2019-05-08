@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h3>Number of Users Joined</h3>
				<div>{!! $users_joined_chart->container() !!}</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center">Quick Actions</h4>
					<hr />
					<a href="{{ url('/admin/courses') }}" class="primary-btn centered small rounded">View Courses</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	{!! $users_joined_chart->script() !!}
@endsection