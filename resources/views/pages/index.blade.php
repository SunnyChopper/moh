@extends('layouts.app')

@section('content')
	@include('layouts.main-banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">Why Does Self-Development Matter?</h2>
			</div>
		</div>

		<div class="row mt-64">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://image.flaticon.com/icons/svg/1789/1789300.svg" class="regular-image-30 centered">
				<h4 class="text-center mt-32">Know Thyself</h4>
				<p class="text-center mt-16 mb-0">If you don't have any self-awareness, you will never truly understand what your strengths and weaknesses are and if that's the case, you will not be able to place yourself in situations where the odds of success are stacked in your favor. With self-development, you can start to learn who you are as an individual, learn what your strengths are and start to use your strengths to maximize the odds of success.</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://image.flaticon.com/icons/svg/1777/1777659.svg" class="regular-image-30 centered">
				<h4 class="text-center mt-32">Laser Focus</h4>
				<p class="text-center mt-16 mb-0">Want to know what both Warren Buffett and Bill Gates thought was the most important character trait for success? It was focus. If you do not have the ability to sit down and focus on a task or even focus on a single mission, it won't matter how much effort you try to exert, you will not be able to move the needle. With self-development and practice, you can build your focus muscle and attain laser focus.</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="https://image.flaticon.com/icons/svg/685/685842.svg" class="regular-image-30 centered">
				<h4 class="text-center mt-32">Control Your Fears</h4>
				<p class="text-center mt-16 mb-0">Fear is an abstract concept that originates from within. It served its purpose for ancient humans, however, in the modern world, we are not constantly being attacked by tigers and bears, so our sense of fear is mostly irrational. By working on the self, you will begin being able to objectively attack your fears and dismantle them. This proves to be very useful when you're trying to achieve big dreams and goals of yours.</p>
			</div>
		</div>
	</div>

	<div style="background: #E1E1E1;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center">Want to Know How Self-Development Can Help You?</h2>
					<p class="text-center mt-8">We've developed a free quiz that you can take to figure out how you can specifically benefit from self-development. Click below to get started.</p>
					<a href="" class="genric-btn primary centered rounded" style="font-size: 18px;">Take the Free Quiz</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">Self-Development Tips</h2>
			</div>
		</div>

		<div class="row mt-32">
			@foreach($posts as $post)
				<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-16-mobile mb-16-mobile">
					<a href="{{ url('/post/' . $post->id . '/' . $post->slug) }}" class="blog-link">
						<div class="image-box-edge">
							<div class="image-box-image set-bg" data-setbg="{{ $post->featured_image_url }}"></div>
							<div class="image-box-info">
								<h5 class="text-center">{{ $post->title }}</h5>
								<p class="mb-0 mt-8">{{ substr(strip_tags($post->body), 0, 128) }}...</p>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>

		<div class="row mt-32">
			<div class="col-12">
				<a href="{{ url('/blog') }}" class="genric-btn primary centered rounded" style="font-size: 16px;">View All Posts</a>
			</div>
		</div>
	</div>
@endsection