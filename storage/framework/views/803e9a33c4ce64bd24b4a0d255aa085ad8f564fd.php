<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h3>Number of Users Joined</h3>
				<div><?php echo $users_joined_chart->container(); ?></div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center">Quick Actions</h4>
					<hr />
					<a href="<?php echo e(url('/admin/courses')); ?>" class="primary-btn centered small rounded">View Courses</a>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
	<?php echo $users_joined_chart->script(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>