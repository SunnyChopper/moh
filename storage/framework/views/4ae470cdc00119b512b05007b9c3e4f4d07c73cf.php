<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<form id="update_content_form" action="/admin/courses/modules/content/update" method="POST">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="module_id" value="<?php echo e($module->id); ?>">
						<input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
						<input type="hidden" name="content_id" value="<?php echo e($content->id); ?>">

						<div class="form-group">
							<h5>Title</h5>
							<p class="mb-2">The title should summarize the video.</p>
							<input type="text" class="form-control" name="title" value="<?php echo e($content->title); ?>" required>
						</div>

						<div class="form-group">
							<h5>Description</h5>
							<p class="mb-2">When a member clicks on the video, they will be able to read this description.</p>
							<textarea class="form-control" name="description" rows="5" form="update_content_form" required><?php echo e($content->description); ?></textarea>
						</div>

						<div class="form-group">
							<h5>Order</h5>
							<p class="mb-2">This is the order of the videos in the module.</p>
							<input type="number" class="form-control" name="order" value="<?php echo e($content->order); ?>" required>
						</div>

						<div class="form-group">
							<h5>YouTube ID</h5>
							<p class="mb-2">This is the ID of the YouTube video. Used in order to embed and more.</p>
							<input type="text" class="form-control" name="youtube_id" value="<?php echo e($content->youtube_id); ?>" required>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn rounded" value="Update Content">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/modules/content/edit.blade.php ENDPATH**/ ?>