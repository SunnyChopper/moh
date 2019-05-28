@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<h4 class="text-center mb-2">Personal Coaching Expiring Link</h4>
					<p class="text-center">The following link will expire in 24 hours.</p>
					<input type="text" class="disabled form-control" disabled="true" value="https://www.mindofhabit.com/personal-coaching?exl={{ $encrypted }}">
				</div>
			</div>
		</div>
	</div>
@endsection