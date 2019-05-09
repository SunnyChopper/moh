<span class="red">*</span>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<form id="update_course_form" action="/admin/courses/update" method="POST">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
						<div class="form-group">
							<h3>Create a New Course</h3>
							<p>Fields with <span class="red">*</span> are required.</p>
						</div>

						<div class="form-group">
							<label>Title<span class="red">*</span>:</label>
							<input type="text" class="form-control" value="<?php echo e($course->title); ?>" name="title" required>
						</div>

						<div class="form-group">
							<label>Description<span class="red">*</span>:</label>
							<textarea class="form-control" rows="5" name="description" form="update_course_form" required><?php echo e($course->description); ?></textarea>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Image URL<span class="red">*</span>:</label>
								<input type="text" name="image_url" value="<?php echo e($course->image_url); ?>" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>YouTube Video ID:</label>
								<input type="text" name="youtube_id" value="<?php echo e($course->youtube_id); ?>" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Price<span class="red">*</span>:</label>
								<input type="number" name="price" class="form-control" value="<?php echo e($course->price); ?>" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label>Monthly Subscription<span class="red">*</span>:</label>
								<select form="update_course_form" class="form-control" name="monthly">
									<option value="0" <?php if ($course->monthly == 0) { echo "selected"; } ?>>No</option>
									<option value="1" <?php if ($course->monthly == 1) { echo "selected"; } ?>>Yes</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" class="primary-btn" value="Update Course">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/edit.blade.php ENDPATH**/ ?>