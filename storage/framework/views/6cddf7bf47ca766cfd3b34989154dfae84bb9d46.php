<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row">
			<?php if(count($courses) > 0): ?>
				<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-12">
					<a href="/courses/<?php echo e($c->id); ?>">
						<div class="image-box-edge">
							<div class="image-box-image set-bg" data-setbg="<?php echo e($c->image_url); ?>"></div>
							<div class="image-box-info">
								<h4 class="mb-2"><?php echo e($c->title); ?></h4>
								<p class="black"><?php echo e($c->description); ?></p>
								<?php if($c->price > 0): ?>
								<h5 class="mb-0"><span class="green">Price: </span> $<?php echo e(sprintf("%.2f", $c->price)); ?></h5>
								<?php else: ?>
								<h5 class="mb-0"><span class="green">Price: </span> FREE</h5>
								<?php endif; ?>
							</div>
						</div>
					</a>
				</div>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php else: ?>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/pages/courses.blade.php ENDPATH**/ ?>