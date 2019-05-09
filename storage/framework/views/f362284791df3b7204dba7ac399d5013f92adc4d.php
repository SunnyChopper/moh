<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?php echo e(URL::asset('img/fav.png')); ?>">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<?php if(isset($page_title)): ?>
		<title><?php echo e(config('app.name')); ?> - <?php echo e($page_title); ?></title>
		<?php else: ?>
		<title><?php echo e(config('app.name')); ?></title>
		<?php endif; ?>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/linearicons.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/font-awesome.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/bootstrap.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/magnific-popup.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/nice-select.css')); ?>">							
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/animate.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/owl.carousel.css')); ?>">			
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/jquery-ui.css')); ?>">			
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/main.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/layouts.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(URL::asset('css/styles.css')); ?>">
	</head>
	<body>
		<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->yieldContent('content'); ?>
		<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('layouts.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/layouts/app.blade.php ENDPATH**/ ?>