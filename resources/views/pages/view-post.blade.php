@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container mt-64 mb-64">
		<div class="row mb-32">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				<img src="{{ $post->featured_image_url }}" class="regular-image-100">
			</div>
		</div>

		<div class="row justify-content-center mb-32">
			<div class="col-lg-8 col-md-10 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-8">How Well Have You Mastered the Self?</h3>
					<p class="text-center black">Take our self-mastery quiz and learn more about yourself and how you can improve. Complete the quiz and we have a special offer for you that can't be found anywhere else on the site.</p>
					<a href="{{ url('/self-dev-quiz') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">Take Self-Mastery Quiz</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				<div id="post-body">
					{!! $post->body !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				<hr />
				<?php $user = App\User::find($post->author_id); ?>
				@if(isset($user->first_name))
					<p><small>Written by {{ $user->first_name }} on {{ $post->created_at->format('M d Y') }}</small></p>
				@else
					<p><small>Written by {{ $uesr->name }} on {{ $post->created_at->format('M d Y') }}</small></p>
				@endif
			</div>
		</div>

		<div class="row justify-content-center mt-32">
			<div class="col-lg-8 col-md-10 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-8">How Well Have You Mastered the Self?</h3>
					<p class="text-center black">Take our self-mastery quiz and learn more about yourself and how you can improve. Complete the quiz and we have a special offer for you that can't be found anywhere else on the site.</p>
					<a href="{{ url('/self-dev-quiz') }}" class="genric-btn primary centered rounded" style="font-size: 14px;">Take Self-Mastery Quiz</a>
				</div>
			</div>
		</div>
	</div>
@endsection