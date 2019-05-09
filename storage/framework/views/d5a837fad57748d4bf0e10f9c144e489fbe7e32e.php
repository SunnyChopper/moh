<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('admin.courses.modals.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<?php if(count($courses) > 0): ?>
			<div class="col-12">

				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Price</th>
								<th>Number of Users</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td style="width: 15%; vertical-align: middle;"><?php echo e($c->title); ?></td>
								<td style="width: 25%; vertical-align: middle;"><?php echo e($c->description); ?></td>
								<td style="width: 10%; vertical-align: middle;">$<?php echo e(sprintf("%.2f", $c->price)); ?></td>
								<td style="width: 15%; vertical-align: middle;"><?php echo e(App\Custom\CourseHelper::getNumMembers($c->id)); ?></td>
								<td style="width: 35%; vertical-align: middle;">
									<a href="<?php echo e(url('/admin/courses/' . $c->id . '/modules/')); ?>" class="genric-btn primary small m-1" style="float: right;">Edit Content</a>
									<a href="<?php echo e(url('/admin/courses/edit/' . $c->id)); ?>" class="genric-btn info small m-1" style="float: right;">Edit</a>
									<button id="<?php echo e($c->id); ?>" class="genric-btn delete_course_button danger small m-1" style="float: right;">Delete</button>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>

				<a href="/admin/courses/new" class="primary-btn centered mt-32">Create New Course</a>
			</div>
			<?php else: ?>
			<div class="col-lg-5 col-md-6 col-sm-10 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Courses</h3>
					<p class="text-center">There are no courses in the system. Click below to create the first one.</p>
					<a href="<?php echo e(url('/admin/courses/new')); ?>" class="primary-btn rounded centered">Create New Course</a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
	<script type="text/javascript">
		$(".delete_course_button").on('click', function() {
			// Get course ID
			var course_id = $(this).attr('id');

			// Set in modal
			$("#delete_course_id").val(course_id);

			// Show modal
			$("#delete_course_modal").modal();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/view.blade.php ENDPATH**/ ?>