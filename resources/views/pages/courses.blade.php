@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row">
			@if(count($courses) > 0)
				@foreach($courses as $c)
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-12">
					<a href="/courses/{{ $c->id }}">
						<div class="image-box-edge">
							<div class="image-box-image set-bg" data-setbg="{{ $c->image_url }}"></div>
							<div class="image-box-info">
								<h4 class="mb-2">{{ $c->title }}</h4>
								<p class="black">{{ $c->description }}</p>
								@if($c->price > 0)
								<h5 class="mb-0"><span class="green">Price: </span> ${{ sprintf("%.2f", $c->price) }}</h5>
								@else
								<h5 class="mb-0"><span class="green">Price: </span> FREE</h5>
								@endif
							</div>
						</div>
					</a>
				</div>

				@endforeach
			@else
			@endif
		</div>
	</div>
@endsection