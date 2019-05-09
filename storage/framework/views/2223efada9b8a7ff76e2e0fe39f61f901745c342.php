<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h3>Courses</h3>
				<p>TODO: Pull data from courses and display here</p>

				<h3 class="mt-32">RICE Planner Tool</h3>
				<p>TODO: Pull data from helper class and display here.</p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="gray-box">
					<h5 class="text-center mb-2">Quick Actions</h5>
					<p class="mb-0 text-center">TODO: Create a helper class to dynamically build quick actions.</p>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/members/dashboard.blade.php ENDPATH**/ ?>