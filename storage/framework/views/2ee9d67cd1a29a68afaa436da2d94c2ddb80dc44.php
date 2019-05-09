<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-6 col-sm-10 col-12">
				<div class="gray-box">
					<form action="/admin/login/attempt" method="POST">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label>Username:</label>
							<input type="text" name="username" value="<?php echo e(Request::old('username')); ?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="password" class="form-control" required>
						</div>

						<?php if(session()->has('error')): ?>
						<div class="form-group">
							<p class="text-center red"><?php echo e(session()->get('error')); ?></p>
						</div>
						<?php endif; ?>

						<div class="form-group">
							<input type="submit" class="primary-btn centered rounded mb-0" value="Login as Admin">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/admin/login.blade.php ENDPATH**/ ?>