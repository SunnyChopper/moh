<header id="header" id="home">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>			
				</div>
				<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
					<a href="mailto:support@colorlib.com"><span class="lnr lnr-envelope"></span> <span class="text">info@mindofhabit.com</span></a>
				</div>
			</div>			  					
		</div>
	</div>
	<div class="container main-menu">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				<a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(URL::asset('img/logo.png')); ?>" alt="" title="" style="width: 50%;" /></a>
			</div>
			<nav id="nav-menu-container">
				<?php if(Auth::guest()): ?>
				<ul class="nav-menu">
					<li><a href="<?php echo e(url('/')); ?>">Home</a></li>
					<li><a href="<?php echo e(url('/courses')); ?>">Courses</a></li>
					
					<li><a href="<?php echo e(url('/blog')); ?>">Blog</a></li>
					<li><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
					<li class="menu-has-children"><a href="">Members</a>
						<ul>
							<li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
							<li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
						</ul>
					</li>
				</ul>
				<?php elseif((!Auth::guest()) && (App\Custom\AdminHelper::isAuthorized() == false)): ?>
				<ul class="nav-menu">
					<li><a href="<?php echo e(url('/members/dashboard')); ?>">Dashboard</a></li>
					<li><a href="<?php echo e(url('/members/courses')); ?>">Courses</a></li>
					
					<li><a href="<?php echo e(url('/blog')); ?>">Blog</a></li>
					<li><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
					<li class="menu-has-children"><a href="">Members</a>
						<ul>
							<li><a href="<?php echo e(url('/members/logout')); ?>">Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php elseif(App\Custom\AdminHelper::isAuthorized() == true): ?>
				<ul class="nav-menu">
					<li><a href="<?php echo e(url('/admin/dashboard')); ?>">Dashboard</a></li>
					<li><a href="<?php echo e(url('/admin/courses')); ?>">Courses</a></li>
					
					<li class="menu-has-children"><a href=""><?php echo e(Auth::user()->first_name); ?></a>
						<ul>
							<li><a href="<?php echo e(url('/members/logout')); ?>">Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php endif; ?>
			</nav>		    		
		</div>
	</div>
</header><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/moh/resources/views/layouts/header.blade.php ENDPATH**/ ?>