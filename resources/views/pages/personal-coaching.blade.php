@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<style type="text/css">
		.custom-social-proof {
			position: fixed;
			bottom: 20px;
			left: 20px;
			z-index: 9999999999999 !important;
			font-family: 'Open Sans', sans-serif;
		}

    	.custom-social-proof > .custom-notification {
	        width: 320px;
	        border: 0;
	        text-align: left;
	        z-index: 99999;
	        box-sizing: border-box;
	        font-weight: 400;
	        border-radius: 6px;
	        box-shadow: 2px 2px 10px 2px hsla(0, 4%, 4%, 0.2);
	        background-color: #fff;
	        position: relative;
	        cursor: pointer;
	    }

        .custom-social-proof > .custom-notification > .custom-notification-container {
            display: flex !important;
            align-items: center;
            height: 80px;
        }

        .custom-social-proof > .custom-notification > .custom-notification-container > .custom-notification-image-wrapper > img {
            max-height: 75px;
            width: 90px;
            overflow: hidden;
            border-radius: 6px 0 0 6px;
            object-fit: cover;
        
        }
        
        .custom-social-proof > .custom-notification > .custom-notification-container > .custom-notification-content-wrapper {
            margin: 0;
            height: 100%;
            color: gray;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 0 6px 6px 0;
            flex: 1;
            display: flex !important;
            flex-direction: column;
            justify-content: center;
        }


        .custom-social-proof > .custom-notification > .custom-notification-container > .custom-notification-content-wrapper >.custom-notification-content {
            font-family: inherit !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 14px;
            line-height: 16px;
                    
        }

        .custom-social-proof > .custom-notification > .custom-notification-container > .custom-notification-content-wrapper >.custom-notification-content > small {
            margin-top: 3px !important;
	        display: block !important;
	        font-size: 12px !important;
	        opacity: .8;
        }

        .custom-close {
            position: absolute;
            top: 8px;
            right: 8px;
            height: 12px;
            width: 12px;
            cursor: pointer;
            transition: .2s ease-in-out;
            transform: rotate(45deg);
            opacity: 0;
            &::before {
                content: "";
                display: block;
                width: 100%;
                height: 2px;
                background-color: gray;
                position: absolute;
                left: 0;
                top: 5px;
            }
            &::after {
                content: "";
                display: block;
                height: 100%;
                width: 2px;
                background-color: gray;
                position: absolute;
                left: 5px;
                top: 0;
            }
        }

        &:hover {
            .custom-close {
                opacity: 1;
            }
        }
    }
}
	</style>

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-6 col-sm-8 col-12">
				<div class="videoWrapper">
				    <!-- Copy & Pasted from YouTube -->
				    <iframe width="560" height="349" src="http://www.youtube.com/embed/n_dZNLr2cME?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

	<section class="custom-social-proof">
		<div class="custom-notification">
			<div class="custom-notification-container">
				<div class="custom-notification-image-wrapper">
					<img src="https://tidings.today/wp-content/uploads/2018/08/tidings-today-logo-fav.png">
				</div>
				<div class="custom-notification-content-wrapper">
					<p class="custom-notification-content">
            			Ricky Garcia<br>just purchased <b>Personal Coaching</b>   
            			<small>1 hour ago</small>
          			</p>
        		</div>
      		</div>
      		<div class="custom-close"></div>
    	</div>
  	</section>
@endsection

@section('page_js')
	<script type="text/javascript">
		setInterval(function() { $(".custom-social-proof").stop().slideToggle('slow'); }, 8000);
     		$(".custom-close").click(function() {
    		$(".custom-social-proof").stop().slideToggle('slow');
    	});
	</script>
@endsection