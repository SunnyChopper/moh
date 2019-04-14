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
				<a href="index.html"><img src="img/logo.png" alt="" title="" style="width: 50%;" /></a>
			</div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/courses') }}">Courses</a></li>
					<li><a href="{{ url('/tools') }}">Tools</a></li>
					<li><a href="{{ url('/blog') }}">Blog</a></li>
					<li><a href="{{ url('/contact') }}">Contact</a></li>
					<li><a href="">Members</a>
						<ul>
							<li><a href="{{ url('/register') }}">Register for Free</a></li>
							<li><a href="{{ url('/login') }}">Login</a></li>
						</ul>
					</li>
				</ul>
			</nav>		    		
		</div>
	</div>
</header>