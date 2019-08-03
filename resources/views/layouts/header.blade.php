<header id="header" id="home">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
					<ul>
						<li><a href="https://www.instagram.com/mindofhabit"><i class="fa fa-instagram"></i></a></li>
						<li><a href="https://www.youtube.com/channel/UCDMZ84EKNAsFRMzVUPMnzbw"><i class="fa fa-youtube"></i></a></li>
					</ul>			
				</div>
				{{-- <div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
					<a href="mailto:jeremy@mindofhabit.com"><span class="lnr lnr-envelope"></span> <span class="text">info@mindofhabit.com</span></a>
				</div> --}}
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
					<li><a href="{{ url('/book-club') }}">Book Club</a></li>
					@if(\App\Custom\CourseHelper::numberOfCourses() > 0)
					<li><a href="{{ url('/courses') }}">Courses</a></li>
					@endif
					<li class="menu-has-children"><a href="{{ url('/tools') }}">Tools</a>
						<ul>
							<li><a href="{{ url('/tools/pomodoro') }}">Pomodoro Tool</a></li>
						</ul>
					</li>
					<li><a href="{{ url('/personal-coaching') }}">Personal Coaching</a></li>
					<li><a href="{{ url('/blog') }}">Blog</a></li>
					{{-- <li><a href="{{ url('/contact') }}">Contact</a></li> --}}
					<li class="menu-has-children"><a href="">Members</a>
						<ul>
							<li><a href="{{ url('/register') }}">Register</a></li>
							<li><a href="{{ url('/login') }}">Login</a></li>
						</ul>
					</li>
				</ul>
				@elseif((!Auth::guest()) && (App\Custom\AdminHelper::isAuthorized() == false))
				<ul class="nav-menu">
					<li><a href="{{ url('/members/dashboard') }}">Dashboard</a></li>
					{{-- <li><a href="{{ url('/members/courses') }}">Courses</a></li> --}}
					<li class="menu-has-children"><a href="">Tools</a>
						<ul>
							<li><a href="{{ url('/members/pomodoro') }}">Pomodoro Tool</a></li>	
							<li><a href="{{ url('/members/student') }}">Student Planner</a></li>	
						</ul>
					</li>
					<li><a href="{{ url('/members/book-club') }}">Book Club</a></li>
					<li><a href="{{ url('/members/personal-coaching') }}">Personal Coaching</a></li>
					<li><a href="{{ url('/blog') }}">Blog</a></li>
					{{-- <li><a href="{{ url('/contact') }}">Contact</a></li> --}}
					@if(Auth::user()->first_name != "")
					<li class="menu-has-children"><a href="">{{ Auth::user()->first_name }}</a>
					@else
					<li class="menu-has-children"><a href="">Members</a>
					@endif
						<ul>
							<li><a href="{{ url('/members/subscriptions') }}">Subscriptions</a></li>
							<li><a href="{{ url('/members/logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
				@elseif(App\Custom\AdminHelper::isAuthorized() == true)
				<ul class="nav-menu">
					<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/book-club') }}">Book Club</a></li>
					<li><a href="{{ url('/admin/courses') }}">Courses</a></li>
					<li class="menu-has-children"><a href="{{ url('/admin/personal-coaching') }}">Personal Coaching</a>
						<ul>
							<li><a href="{{ url('/admin/personal-coaching/consultations') }}">Free Consultations <span class="badge badge-primary ml-1" style="padding: 4px; font-size: 11px;">{{ \App\Custom\MentorHelper::getNumberOfOpenFreeConsultations() }}</span></a></li>
						</ul>
					</li>
					<li class="menu-has-children"><a href="">Links</a>
						<ul>
							<li><a href="{{ url('/admin/links/personal-coaching') }}">Personal Coaching Link</a></li>
						</ul>
					</li>
					<li><a href="{{ url('/admin/posts') }}">Blog</a></li>
					{{-- <li><a href="{{ url('/tools') }}">Tools</a></li> --}}
					@if(Auth::user()->first_name != "")
					<li class="menu-has-children"><a href="">{{ Auth::user()->first_name }}</a>
						<ul>
							<li><a href="{{ url('/admin/logout') }}">Logout</a></li>
						</ul>
					</li>
					@else
					<li class="menu-has-children"><a href="">Members</a>
						<ul>
							<li><a href="{{ url('/admin/logout') }}">Logout</a></li>
						</ul>
					</li>
					@endif
				</ul>
				@endif
			</nav>		    		
		</div>
	</div>
</header>