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
				<a href="{{ url('/') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="" title="" style="width: 50%;" /></a>
			</div>
			<nav id="nav-menu-container">
				@if(Auth::guest())
				<ul class="nav-menu">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/courses') }}">Courses</a></li>
					{{-- <li><a href="{{ url('/tools') }}">Tools</a></li> --}}
					<li><a href="{{ url('/blog') }}">Blog</a></li>
					<li><a href="{{ url('/contact') }}">Contact</a></li>
					<li><a href="">Members</a>
						<ul>
							<li><a href="{{ url('/register') }}">Register</a></li>
							<li><a href="{{ url('/login') }}">Login</a></li>
						</ul>
					</li>
				</ul>
				@elseif((!Auth::guest()) && (App\Custom\AdminHelper::isAuthorized() == false))
				<ul class="nav-menu">
					<li><a href="{{ url('/members/dashboard') }}">Dashboard</a></li>
					<li><a href="{{ url('/members/courses') }}">Courses</a></li>
					{{-- <li><a href="{{ url('/tools') }}">Tools</a></li> --}}
					<li><a href="{{ url('/blog') }}">Blog</a></li>
					<li><a href="{{ url('/contact') }}">Contact</a></li>
					<li><a href="">Members</a>
						<ul>
							<li><a href="{{ url('/members/logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
				@elseif(App\Custom\AdminHelper::isAuthorized() == true)
				<ul class="nav-menu">
					<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/courses') }}">Courses</a></li>
					{{-- <li><a href="{{ url('/tools') }}">Tools</a></li> --}}
					<li><a href="">{{ Auth::user()->first_name }}</a>
						<ul>
							<li><a href="{{ url('/members/logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
				@endif
			</nav>		    		
		</div>
	</div>
</header>