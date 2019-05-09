<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<?php if(count($modules) > 0): ?>
			<?php else: ?>
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Course Modules</h3>
					<p class="text-center">There are no modules for this course. Click below to get started.</p>
					<a href="/admin/courses/<?php echo e($course->id); ?>/modules/new" class="primary-btn centered rounded">Create New Module</a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/content/view.blade.php ENDPATH**/ ?>