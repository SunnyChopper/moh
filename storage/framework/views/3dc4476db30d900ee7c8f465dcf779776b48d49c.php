<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('admin.courses.modules.modals.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<?php if(count($modules) > 0): ?>
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
							<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td style="vertical-align: middle; width: 10%;"><?php echo e($m->order); ?></td>
								<td style="vertical-align: middle; width: 20%;"><?php echo e($m->title); ?></td>
								<td style="vertical-align: middle; width: 35%;"><?php echo e($m->description); ?></td>
								<td style="vertical-align: middle; width: 35%;">
									<a href="<?php echo e(url('/admin/courses/' . $course->id . '/modules/' . $m->id . '/edit')); ?>" class="genric-btn info rounded small m-2" style="float: right;">Edit</a>
									<button class="genric-btn danger rounded small m-2 delete_module_button" id="<?php echo e($m->id); ?>" style="float: right;">Delete</button>
									<a href="<?php echo e(url('/admin/courses/' . $course->id . '/modules/' . $m->id . '/content')); ?>" class="genric-btn primary rounded small m-2" style="float: right;">Edit Content</a>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>

					<div class="centered">
						<a href="<?php echo e(url('/admin/courses')); ?>" class="genric-btn primary centered rounded" style="display: inline-block;">Back to Courses</a>
						<a href="/admin/courses/<?php echo e($course->id); ?>/modules/new" class="genric-btn info centered rounded" style="display: inline-block;">Create New Module</a>
					</div>
				</div>
			</div>
			<?php else: ?>
			<div class="col-12">
				
			</div>

			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-2">No Course Modules</h3>
					<p class="text-center">There are no modules for this course. Click below to get started.</p>
					<div class="centered">
						<a href="<?php echo e(url('/admin/courses')); ?>" class="genric-btn info rounded">Back to Courses</a>
						<a href="/admin/courses/<?php echo e($course->id); ?>/modules/new" class="genric-btn primary rounded">Create New Module</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
	<script type="text/javascript">
		$(".delete_module_button").on('click', function() {
			// Get module ID
			var module_id = $(this).attr('id');

			// Set in modal
			$("#delete_module_id").val(module_id);

			// Show modal
			$("#delete_module_modal").modal();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/courses/modules/view.blade.php ENDPATH**/ ?>