<section class="banner-area relative about-banner" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					@if(isset($page_header))
					{{ $page_header }}
					@else
					{{ config('app.name') }}
					@endif		
				</h1>
			</div>	
		</div>
	</div>
</section>