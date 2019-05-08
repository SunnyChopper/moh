@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-6 col-sm-10 col-12">
				<div class="gray-box">
					<form action="/admin/login/attempt" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Username:</label>
							<input type="text" name="username" value="{{ Request::old('username') }}" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="password" class="form-control" required>
						</div>

						@if(session()->has('error'))
						<div class="form-group">
							<p class="text-center red">{{ session()->get('error') }}</p>
						</div>
						@endif

						<div class="form-group">
							<input type="submit" class="primary-btn centered rounded mb-0" value="Login as Admin">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection