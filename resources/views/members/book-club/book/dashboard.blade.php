@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class='container pt-64 pb-64'>
		<div class='row justify-content-center'>
			<div class='col-lg-8 col-md-8 col-sm-12 col-12'>
				<h3 class="light-font mb-2">Description of {{ $book->title }}</h3>
				<p class="black mb-4">{{ $book->description }}</p>
				<h3 class="light-font">Notes for {{ $book->title }}</h3>
				@if($notes != null)
				<div class="row mt-8">
					<div class="col-12">
						{!! $notes->html !!}
					</div>
				</div>
				@endif
			</div>

			<div class='col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile'>
				<div class='gray-box'>
					<h4 class='text-center mb-3'>Quick Actions</h4>
					<button type='button' class='genric-btn full-width info rounded mb-2 mt-2 view_downloads_button' style='font-size: 15px;'>View Downloadables</button>
					<a href='{{ url('/members/book-club/' . $book->id . '/forums') }}' class='genric-btn full-width info rounded mb-2 mt-2' style='font-size: 15px;'>View Forums</a>
				</div>

				@if(count($links) > 0)
				<h4 class="text-center mt-4">Book Links</h4>
				<ul class="list-group mt-8">
					@foreach($links as $link)
					<a href="{{ $link->url }}">
						<li class="list-group-item">
							<h6 class="text-center light-font mb-0">{{ $link->title }}</h6>
						</li>
					</a>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type='text/javascript'>
		
	</script>
@endsection