@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<style type="text/css">
        #title {
            font-size: 36px;
        }

        @media (max-width: 767px) {
            .about-content {
                margin-top: 30px;
                padding-bottom: 30px;
            }

            #title {
                font-size: 20px;
            }
        }
	</style>

	<div class="container pt-64 pb-64 pt-32-mobile">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-32 text-center light-font" id="title" style='line-height: 1.5em !important;'>Constantly Solve More in Less Time and Reveal Your Confidence and Focus to the World</h1>
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
                <h4 class="mb-16 text-center" style="line-height: 1.5em !important; font-size: 22px;">Did You Know That You Are Capable of Unlocking Laser Focus, Sporting an Unshakable Confidence, and Having a Deeper Lifelong Purpose</h4>
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
                    <h2 class="text-center mb-64">What You Will Unlock with Personal Coaching</h2>
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
                <h3 style="line-height: 1.5em !important;">Apply Today to Gain Access to These Powerful Tools</h3>
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
                    <h3 class="text-center light-font">Personal Mentorship Application</h3>
                    <p class="text-center light-font"><small>Fields with <span class="red">*</span> are required.</small></p>

                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label class="mb-2">First name <span class="red">*</span></label>
                            <input type="text" id="app_first_name" class="form-control">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
                            <label class="mb-2">Last name</label>
                            <input type="text" id="app_last_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label class="mb-2">Email <span class="red">*</span></label>
                            <input type="email" id="app_email" class="form-control">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
                            <label class="mb-2">Phone <span class="red">*</span></label>
                            <input type="text" id="app_phone" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">When would you like us to call about your application? <span class="red">*</span></label>
                            <input type="time" id="app_call_time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">How long have you been working on yourself? <span class="red">*</span></label>
                            <select class="form-control" id="app_years">
                                <option value="0">0 - 1 years</option>
                                <option value="1">1 - 2 years</option>
                                <option value="2">2 - 3 years</option>
                                <option value="3">3 - 4 years</option>
                                <option value="4">4 - 5 years</option>
                                <option value="5">5 - 6 years</option>
                                <option value="6">6 - 7 years</option>
                                <option value="7">7 - 8 years</option>
                                <option value="8">8 - 9 years</option>
                                <option value="9">9 - 10 years</option>
                                <option value="10">10+ years</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">How badly do you want to improve yourself? <span class="red">*</span></label>
                            <select class="form-control" id="app_determination_score">
                                <option value="1">Just exploring self-development</option>
                                <option value="2">Not serious but interested</option>
                                <option value="3">Somewhat serious about improving</option>
                                <option value="4">I work hard to improve myself daily</option>
                                <option value="5">Obsessed with improving myself</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">What are your strengths? <span class="red">*</span></label>
                            <textarea id="app_strengths" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">What are your weaknesses? <span class="red">*</span></label>
                            <textarea id="app_weaknesses" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">We have limited spots. Why should we pick you? <span class="red">*</span></label>
                            <textarea id="app_why" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <label class="mb-2">Why are you trying to improve yourself? <span class="red">*</span></label>
                            <textarea id="app_purpose" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <p id="submission_error" class="text-center red" style="display: none;">Please fill out all fields.</p>
                    <p id="submission_success" class="text-center green" style="display: none;">Successfully submitted your application. We will call you soon!</p>

                    <div class="form-group row mt-16">
                        <div class="col-12">
                            <button class="genric-btn primary rounded centered submit" style="font-size: 18px;">Submit Application</button>
                        </div>
                    </div>
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
        var _token = '{{ csrf_token() }}';
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var first_name = $("#app_first_name").val();
        var last_name = $("#app_last_name").val();
        var email = $("#app_email").val();
        var phone = $("#app_phone").val();
        var call_time = $("#app_call_time").val();
        var years = $("#app_years").val();
        var determination_score = $("#app_determination_score").val();
        var strengths = $("#app_strengths").val();
        var weaknesses = $("#app_weaknesses").val();
        var why = $("#app_why").val();
        var purpose = $("#app_purpose").val();

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

        function updateVariables() {
            first_name = $("#app_first_name").val();
            email = $("#app_email").val();
            phone = $("#app_phone").val();
            call_time = $("#app_call_time").val();
            years = $("#app_years").val();
            determination_score = $("#app_determination_score").val();
            strengths = $("#app_strengths").val();
            weaknesses = $("#app_weaknesses").val();
            why = $("#app_why").val();
            purpose = $("#app_purpose").val();
        }

        function validateApplication() {
            updateVariables();

            if (first_name != "" && email != "" && phone != "" && call_time != "" && years != "" && determination_score != "" && strengths != "" && weaknesses != "" && why != "" && purpose != "") {
                $("#submission_error").hide();
                return true;
            } else {
                $('#submission_error').html('Please fill out all required fields.');
                $("#submission_error").show();
                return false;
            }
        }

        function disableSubmitButton() {
            $(".submit").prop('disabled', true);
            $(".submit").removeClass('primary');
            $(".submit").addClass('disabled');
        }

        function enableSubmitButton() {
            $(".submit").prop('disabled', false);
            $(".submit").addClass('primary');
            $(".submit").removeClass('disabled');
        }

        $(".submit").on('click', function() {
            disableSubmitButton();
            if (validateApplication() == true) {
                updateVariables();

                $.ajax({
                    url : '/api/personal-coaching/application/submit',
                    type : 'POST',
                    data : {
                        '_token' : _token,
                        'first_name' : first_name,
                        'last_name' : last_name,
                        'email' : email,
                        'phone' : phone,
                        'timezone' : timezone,
                        'call_time' : call_time,
                        'years' : years,
                        'determination_score' : determination_score,
                        'strengths' : strengths,
                        'weaknesses' : weaknesses,
                        'why' : why,
                        'purpose' : purpose
                    },
                    success : function(data) {
                        if (data == true) {
                            $('#submission_success').show();
                        } else {
                            $('#submission_error').html('Something went wrong while submitting your application...');
                            enableSubmitButton();
                        }
                    }
                });
            } else {
                enableSubmitButton();
            }
            
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