<section class="banner-area relative about-banner" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?php if(isset($page_header)): ?>
					<?php echo e($page_header); ?>

					<?php else: ?>
					<?php echo e(config('app.name')); ?>

					<?php endif; ?>		
				</h1>
			</div>	
		</div>
	</div>
</section><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/layouts/banner.blade.php ENDPATH**/ ?>