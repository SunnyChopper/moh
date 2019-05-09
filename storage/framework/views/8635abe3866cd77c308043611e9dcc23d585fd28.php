<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('admin.courses.modules.content.modals.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<?php if(count($videos) > 0): ?>
			<div class="col-12">
				
				<div style="overflow: auto;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Order</th>
								<th>Title</th>
								<th>Description</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td style="width: 10%; vertical-align: middle;"><?php echo e($v->order); ?></td>
								<td style="width: 15%; vertical-align: middle;"><?php echo e($v->title); ?></td>
								<td style="width: 50%; vertical-align: middle;"><?php echo e($v->description); ?></td>
								<td style="width: 25%; vertical-align: middle;">
									<a href="<?php echo e(url('/admin/courses/' . $course->id . '/modules/' . $module->id . '/content/' . $v->id . '/edit')); ?>" class="genric-btn info rounded m-2 small" style="float: right;">Edit</a>
									<button class="genric-btn danger rounded m-2 small delete_content_button" id="<?php echo e($v->id); ?>" style="float: right;">Delete</button>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>

					<div class="centered">
						<a href="<?php echo e(url('/admin/courses/' . $course->id . '/modules')); ?>" class="genric-btn primary rounded">Back to Modules</a>
						<a href="/admin/courses/<?php echo e($course->id); ?>/modules/<?php echo e($module->id); ?>/content/new" class="genric-btn info rounded">Create New Content</a>
					</div>
				</div>
			</div>
			<?php else: ?>
			<div class="col-12">
				
			</div>

			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Content</h3>
					<p class="text-center">There is no videos in this module. Click below to get started on adding content.</p>
					<div class="centered">
						<a href="<?php echo e(url('/admin/courses/' . $course->id . '/modules')); ?>" class="genric-btn primary rounded">Back to Modules</a>
						<a href="/admin/courses/<?php echo e($course->id); ?>/modules/<?php echo e($module->id); ?>/content/new" class="genric-btn info rounded">Create New Content</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
	<script type="text/javascript">
		$(".delete_content_button").on('click', function() {
			// Get content ID
			var content_id = $(this).attr('id');

			// Set in modal
			$("#delete_content_id").val(content_id);

			// Show modal
			$("#delete_course_content_modal").modal();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/modules/content/view.blade.php ENDPATH**/ ?>