<footer class="footer-area section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h4>Quick links</h4>
					<ul>
						@if(Auth::guest())
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{ url('/blog') }}">Blog</a></li>
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ url('/register') }}">Register</a></li>
						@elseif((!Auth::guest()) && (App\Custom\AdminHelper::isAuthorized() == false))
						<li><a href="{{ url('/members/dashboard') }}">Dashboard</a></li>
						<li><a href="{{ url('/blog') }}">Blog</a></li>
						<li><a href="{{ url('/members/logout') }}">Logout</a>
						@else
						<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
						<li><a href="{{ url('/admin/personal-coaching') }}">Personal Coaching</a></li>
						<li><a href="{{ url('/admin/posts') }}">Blog Posts</a>
						@endif
					</ul>								
				</div>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h4>Products</h4>
					<ul>
						<li><a href="{{ url('/personal-coaching') }}">Personal Coaching</a></li>
					</ul>								
				</div>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					{{-- <h4>Services</h4>
					<ul>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Research</a></li>
						<li><a href="#">Experts</a></li>
						<li><a href="#">Agencies</a></li>
					</ul>	 --}}							
				</div>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="single-footer-widget">							
				</div>
			</div>																	
			<div class="col-lg-4  col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h4>Want More Content?</h4>
					<p>Get the latest tips on mastering the mind</p>
					<div class="" id="mc_embed_signup">
						<form action="/api/newsletter/subscribe" method="POST">
							{{ csrf_field() }}
							<div class="input-group">
						    	<input type="text" class="form-control" name="EMAIL" placeholder="Enter Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address '" required="" type="email">
						    	<div class="input-group-btn">
						      		<button class="btn btn-default" type="submit">
						        		<span class="lnr lnr-arrow-right"></span>
						      		</button>    
						    	</div>
						    	<div class="info"></div>  
						  	</div>
						</form> 
					</div>
				</div>
			</div>											
		</div>
		<div class="footer-bottom row align-items-center justify-content-between">
			<p class="footer-text m-0 col-lg-6 col-md-12">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
			<div class="col-lg-6 col-sm-12 footer-social">
				<a href="https://www.instagram.com/mindofhabit"><i class="fa fa-instagram"></i></a>
				<a href="https://www.youtube.com/channel/UCDMZ84EKNAsFRMzVUPMnzbw"><i class="fa fa-youtube"></i></a>
			</div>
		</div>						
	</div>
</footer>