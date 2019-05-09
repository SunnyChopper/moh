<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<?php if($course->youtube_id != ""): ?>
				<div class="videoWrapper">
				    <!-- Copy & Pasted from YouTube -->
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/<?php echo e($course->youtube_id); ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>
				<?php else: ?>
				<img src="<?php echo e($course->image_url); ?>" class="regular-image-100">
				<?php endif; ?>

				<h3 class="mt-16"><?php echo e($course->title); ?></h3>
				<p><?php echo e($course->description); ?></p>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="gray-box">
					<h5 class="text-center">Enroll in Course</h5>
					<hr />
					<div class="row">
						<div class="col-6">
							<h6>Total:</h6>
						</div>

						<div class="col-6">
							<p class="mb-0 black" style="float: right;">$<?php echo e(sprintf("%.2f", $course->price)); ?></p>
						</div>
					</div>
					<hr />

					<?php if(Auth::guest()): ?>
					<p class="black text-center">If you do not have an account with Mind of Habit, click the button below to get registered and enrolled at the same time.</p>
					<a href="<?php echo e(url('/register?redirect_action=/courses/' . $course->id . '/enroll')); ?>" class="genric-btn primary rounded centered mb-4">Register and Enroll</a>
					<p class="black text-center">If you already have an account, click the button below to login and enroll.</p>
					<a href="<?php echo e(url('/login?redirect_action=/courses/' . $course->id . '/enroll')); ?>" class="genric-btn info rounded centered mb-0">Login and Enroll</a>
					<?php else: ?>
					<a href="<?php echo e(url('/courses/' . $course->id . '/enroll')); ?>" class="genric-btn info rounded centered">Enroll in Course</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/pages/view-course.blade.php ENDPATH**/ ?>