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
        <div class="row">
            <div class="col-12">
                <h1 class="mb-32 text-center light-font" style='line-height: 1.5em !important;'>Constantly Solve More in Less Time and Reveal Your Confidence and Focus to the World</h1>
            </div>
        </div>

		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="videoWrapper">
				    <iframe width="560" height="349" src="https://www.youtube.com/embed/BQ-JAOh7-d4?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
				</div>
                @if($special_link == true)
                    @if($expired_link == false)
                        <h4 class="text-center mt-32">Price: <span class="red"><strike>$497/month</strike></span> <span class="red"><strike>$67/month</strike></span> <span class="green">$50/month</span></h4>
                        <h3 class="text-center mt-16">Hurry! This link expires in...</h3>
                        <h5 class="text-center mt-8" id="timer"></h5>
                    @endif
                @endif
                <a href="#pc-form" class="genric-btn primary centered rounded large mt-16" style="font-size: 18px;">Start Your Application <i class=" ml-2 fa fa-arrow-circle-right"></i></a>
                
			</div>
        </div>

        <div class="row justify-content-center mt-32">
            <div class="col-lg-9 col-md-10 col-sm-12 col-12">
                <h3 class="mb-16 text-center" style="line-height: 1.5em !important">You Are More Than Capable of Attaining Laser Focus, Strong Confidence, and a Lifelong Purpose</h3>
                <p class="black">If you've tried a self-development course in the past and didn't find it to work, you're not alone. They rarely ever work. But this does not mean that you are incapable of improving.</p>
                <p class="black">You're more than capable of improving and you know it deep down yourself. These past courses were extreme over-simplifications of what you need to know. They give you a lot of fluff. They give you a lot of theory. That's not the case here.</p>
                <p class="black">You can ask our 300,000+ followers if we ever talk about fluff or useless theory, they'll say no. You're only going to get the good stuff. But we do have to warn you, unlike many other courses, we do not sugarcoat anything. If you are the one to find truths offensive, you can close this page out. We are not going to hold back.</p>
                <p class="black">If you believe you're ready to start, click below to apply for a spot. We do not let everyone in. We do this because we only want to work with the most dedicated and most willing. It's like we have a lot of gasoline, but without a spark, it does nothing. You are that spark. The more dedicated and willing you are, the bigger that spark is going to be.</p>
                <p class="black">So are you ready to start taking real action that leads to real results? If so, click below to apply for a spot.</p>
                
                <a href="#pc-form" class="genric-btn primary centered rounded large mt-16" style="font-size: 18px;">Start Your Application <i class=" ml-2 fa fa-arrow-circle-right"></i></a>
            </div>
		</div>
	</div>

    <div style="background: #EAEAEA;">
        <div class="container pt-64 pb-64">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-64">What You Will Get</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/1636/1636025.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Appointments</h3>
                    <p class="text-center">Get direct access to your mentor by scheduling an appointment. You can then talk to your mentor about your specific situation and get immediate feedback and action items.</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/1660/1660882.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Recommendations</h3>
                    <p class="text-center">The internet is massive and fitting it all onto this website is impossible, so your mentor can recommend you resources and links that aim to solve a specific issue you might have.</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/185/185983.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Personalized Videos</h3>
                    <p class="text-center">If you need a specific lesson that can be taught through a video, your mentor will create a video specific to your situation and share that with you to help you succeed.</p>
                </div>
            </div>

            <div class="row mt-64">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/1039/1039328.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Shared Documents</h3>
                    <p class="text-center">Your mentor can share important documents and spreadsheets with you. These documents can be custom-tailored to your needs and specific situation to help you achieve mastery.</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/254/254043.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Direct Messaging</h3>
                    <p class="text-center">Got a question that you want answered but don't have an appointment booked to talk about it? No problem, go ahead and message your mentor and you'll have an answer in no time.</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <img src="https://image.flaticon.com/icons/svg/1055/1055672.svg" class="centered regular-image-30 mb-16">
                    <h3 class="mb-16 text-center">Assigned Tasks</h3>
                    <p class="text-center">Your mentor can assign tasks to you to help keep you on track. This will allow your mentor to hold you accountable and make sure that progress is being made.</p>
                </div>
            </div>

            <a href="#pc-form" class="genric-btn primary centered rounded large mt-16" style="font-size: 18px;">Start Your Application <i class=" ml-2 fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div style="background: #24252a;">
        <div class="container pt-64 pb-64">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center white mb-16">30-Day Money Back Guarantee</h2>
                    <p class="text-center white mb-0"><big>We're so confident that you will see progress in mastering yourself that we're going to offer you a 30-day money back guarantee. If you don't see any sliver of progress, you can contact us and we'll get you your money back.</big></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-64 pb-64">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <h3>What You Will Get</h3>
                <hr />
                <h5 class="mb-2">1. Appointments</h5>
                <p class="mb-4">Schedule an appointment with your mentor and get direct 1-on-1 access on how to solve your specific problems. Other sites like coach.me will charge you up to $125 per call, but with us, this comes included in the personal coaching package.</p>
                <h5 class="mb-2">2. Recommendations</h5>
                <p class="mb-4">The learning doesn't stop once you're done with your appointment. Your mentor can recommend you articles, movies, books, courses, and much more. Your recommendations are custom-tailored to your specific situation. There's no artificial intelligent robot that's recommending you resources, it's a real human being that cares about you and your success.</p>
                <h5 class="mb-2">3. Personalized Videos</h5>
                <p class="mb-4">Think of this as your personal teacher who just became a YouTuber. Instead of watching some generic video that's meant for a broader audience, get a video from your mentor that answers your specific questions.</p>
                <h5 class="mb-2">4. Shared Documents</h5>
                <p class="mb-4">Get access to documents and spreadsheets that are custom-tailored to help you succeed. You no longer have to go get some generic spreadsheet from the internet when your mentor can create something that is meant to be shared with just you.</p>
                <h5 class="mb-2">5. Direct Messaging</h5>
                <p class="mb-4">Having a direct communication line with your mentor is extremely valuable. Booking appointments to talk to your mentor can have you wait, however, by being able to text your mentor, you can ask as many questions as you want and expect to get an answer faster than you would by waiting for an appointment.</p>
                <h5 class="mb-2">6. Assigned Tasks</h5>
                <p class="mb-0">Every mentor wants to see their mentee succeed and one of the ways to help you succeed is by holding you accountable and making sure that you're on the right path. By having your mentor assign you tasks, you get actionable items that you can execute to see immediate feedback on how fast you're improving.</p>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-32-mobile">
                <div class="gray-box" id="pc-form">
                    <form id="enroll_personal_coaching_form" action="/personal-coaching/enroll" method="POST">
                        {{ csrf_field() }}
                        @if($special_link == true)
                            @if($expired_link == false)
                                <input type="hidden" value="1" name="special_link">
                            @endif
                        @else
                            <input type="hidden" value="0" name="special_link">
                        @endif

                        <h3 class="text-center mb-32">Master Your Self</h3>
                        @if(Auth::guest())
                            <h5>Step 1: Create a Mind of Habit account</h5>
                            @if($special_link == true)
                                @if($expired_link == false)
                                    <p class="mb-0">If you already have a Mind of Habit account, click <a href="{{ url('/login?redirect_action=/personal-coaching?exl=' . $_GET['exl']) }}">here</a> to login.</p>
                                @endif
                            @else
                                <p class="mb-0">If you already have a Mind of Habit account, click <a href="{{ url('/login?redirect_action=/personal-coaching') }}">here</a> to login.</p>
                            @endif
                            
                            <hr />

                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-8-mobile">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                                <p class="red mb-0 mt-2" id="username_taken" style="display: none;">Username is taken.</p>
                            </div>

                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <p class="red mb-0 mt-2" id="email_taken" style="display: none;">Email is taken.</p>
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <h5 class="mt-32">Step 2: Payment Info</h5>
                            <hr />

                            <div class="form-group">
                                <label>Card Number:</label>
                                <input type="text" name="card_number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Security Code (CVV):</label>
                                <input type="num" name="cvvNumber" class="form-control" min="0" max="999" step="1" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label>Expiry Month:</label>
                                    <select form="enroll_personal_coaching_form" class="form-control" name="ccExpiryMonth">
                                        <option value="01">01 - January</option>
                                        <option value="02">02 - February</option>
                                        <option value="03">03 - March</option>
                                        <option value="04">04 - April</option>
                                        <option value="05">05 - May</option>
                                        <option value="06">06 - June</option>
                                        <option value="07">07 - July</option>
                                        <option value="08">08 - August</option>
                                        <option value="09">09 - September</option>
                                        <option value="10">10 - October</option>
                                        <option value="11">11 - November</option>
                                        <option value="12">12 - December</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-8-mobile">
                                    <label>Expiry Year:</label>
                                    <select form="enroll_personal_coaching_form" class="form-control" name="ccExpiryYear">
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                            </div>
                        @else

                            <h5 class="green">Step 1: Create a Mind of Habit account</h5>
                            <hr />
                            <p>Logged in as <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong></p>

                            <h5 class="mt-32">Step 2: Payment Info</h5>
                            <hr />

                            <div class="form-group">
                                <label>Card Number:</label>
                                <input type="text" name="card_number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Security Code (CVV):</label>
                                <input type="num" name="cvvNumber" class="form-control" min="0" max="999" step="1" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label>Expiry Month:</label>
                                    <select form="enroll_personal_coaching_form" class="form-control" name="ccExpiryMonth">
                                        <option value="01">01 - January</option>
                                        <option value="02">02 - February</option>
                                        <option value="03">03 - March</option>
                                        <option value="04">04 - April</option>
                                        <option value="05">05 - May</option>
                                        <option value="06">06 - June</option>
                                        <option value="07">07 - July</option>
                                        <option value="08">08 - August</option>
                                        <option value="09">09 - September</option>
                                        <option value="10">10 - October</option>
                                        <option value="11">11 - November</option>
                                        <option value="12">12 - December</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label>Expiry Year:</label>
                                    <select form="enroll_personal_coaching_form" class="form-control" name="ccExpiryYear">
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <hr />

                        <div class="form-group row">
                            <div class="col-6">
                                <h5>Today's Total:</h5>
                            </div>

                            <div class="col-6">
                                <h5 style="float: right;">
                                    @if($special_link == true)
                                        @if($expired_link == false)
                                            <span class="green">$50.00</span>
                                        @endif
                                    @else
                                        $67.00
                                    @endif
                                </h5>
                            </div>
                        </div>

                        <div class="form-group mt-32">
                            <input type="submit" id="submit_button" class="genric-btn large rounded primary centered" value="Let's Get Started" style="font-size: 18px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	{{-- <section class="custom-social-proof">
		<div class="custom-notification">
			<div class="custom-notification-container">
				<div class="custom-notification-image-wrapper">
					<img id="custom-notification-image" src="https://tidings.today/wp-content/uploads/2018/08/tidings-today-logo-fav.png">
				</div>
				<div class="custom-notification-content-wrapper">
					<p id="custom-notification-text" class="custom-notification-content">
            			Ricky Garcia<br>just purchased <b>Personal Coaching</b>   
            			<small>1 hour ago</small>
          			</p>
        		</div>
      		</div>
      		<div class="custom-close"></div>
    	</div>
  	</section> --}}
@endsection

@section('page_js')
	<script type="text/javascript">
        $(document).ready(function() {
            @if($special_link == true)
                @if($expired_link == false)
                    var countDownDate = new Date("{{ Carbon\Carbon::parse(Crypt::decrypt($_GET['exl']))->format('m/d/y h:i:s') }}").getTime();
                    
                    var x = setInterval(function() {
                        var now = new Date().getTime();
                        var distance = countDownDate - now;

                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        $("#timer").html(hours + " hours, " + minutes + " minutes, " + seconds + " seconds");

                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("timer").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                @endif
            @endif
        });

		setInterval(function() { $(".custom-social-proof").stop().slideToggle('slow'); }, 8000);
     		$(".custom-close").click(function() {
    		$(".custom-social-proof").stop().slideToggle('slow');
    	});

        $(document).ready(function() {
            $("#username").on('change', function() {
                $.ajax({
                    url: '/api/username/check',
                    type: 'POST',
                    data: {
                        '_token' : '{{ csrf_token() }}',
                        'username' : $(this).val()
                    },
                    success: function(response) {
                        if (response == false) {
                            console.log('Username not taken.');
                            $("#username").css('border', '1px solid green');
                            $("#username_taken").hide();
                            $("#submit_button").prop('disabled', false);
                            $("#submit_button").removeClass('disabled');
                            $("#submit_button").addClass('primary');
                        } else {
                            $("#username").css('border', '1px solid red');
                            $("#username_taken").show();
                            $("#submit_button").prop('disabled', true);
                            $("#submit_button").removeClass('primary');
                            $("#submit_button").addClass('disabled');
                        }
                    }
                });
            });

            $("#email").on('change', function() {
                $.ajax({
                    url: '/api/email/check',
                    type: 'POST',
                    data: {
                        '_token' : '{{ csrf_token() }}',
                        'email' : $(this).val()
                    },
                    success: function(response) {
                        if (response == false) {
                            console.log('Email not taken.');
                            $("#email").css('border', '1px solid green');
                            $("#email_taken").hide();
                            $("#submit_button").removeClass('disabled');
                            $("#submit_button").addClass('primary');
                        } else {
                            $("#email").css('border', '1px solid red');
                            $("#email_taken").show();
                            $("#submit_button").removeClass('primary');
                            $("#submit_button").addClass('disabled');
                        }
                    }
                });
            });
        });
	</script>
@endsection