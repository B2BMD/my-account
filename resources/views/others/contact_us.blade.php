<!DOCTYPE html>

<html lang="en">

<head>
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/contact-us.css') }}" type="text/css" rel="stylesheet" media="screen" />

    <style type="text/css">
        :root {
        
            --Primarycolor-rgb: 0, 110, 255;
            --notice-rgb: 251, 143, 20;
            --Headingcolor: #2680BC;
            --Bodytextcolor: #080808;
            /* // Button color */
            --Button_bg: #2680BC;
            --Button_textcolor: #FFFFFF;
            --Button_hovercolor: #2680BC;
            /* // Button color */

            /* // Header color */
            --Header_bg: #FFFFFF;
            --Header_Navigation_textcolor: #080808;
            --Header_element_color: #080808;
            /* // Header color */

            /* // Footer color */
            --Footer_bg: #080808;
            --Footer_Navigation_textcolor: #FFFFFF;
            --Footer_element_color: #FFFFFF;
            /* // Footer color */

            /* // Page color */
            --Page_bg: #FFFFFF;

            /* // Corner radius */
            --Button_Corner_radius: 5px;
            --Tiles_Corner_radius: 5px;
            --Corner_radius: 5px;
            /* // medium = 5,rounded = 50px,sqaure = 0*/

            /* // Alignment */
            --Alignment: left;

            /* //  FONTS Families */
            --Body_text: Proxima_Nova_Regular;
            --Proxima_Nova_SemiBold: Proxima_Nova_Semibold;
            --Heading_text: Proxima_Nova_Bold;
        }
    </style>
</head>
@include('layout.favicon')
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">
        <div class="loader" style="display:none;">
            <div>
                <div class="sk-circle">
                    <div class="sk-circle1 sk-child"></div>
                    <div class="sk-circle2 sk-child"></div>
                    <div class="sk-circle3 sk-child"></div>
                    <div class="sk-circle4 sk-child"></div>
                    <div class="sk-circle5 sk-child"></div>
                    <div class="sk-circle6 sk-child"></div>
                    <div class="sk-circle7 sk-child"></div>
                    <div class="sk-circle8 sk-child"></div>
                    <div class="sk-circle9 sk-child"></div>
                    <div class="sk-circle10 sk-child"></div>
                    <div class="sk-circle11 sk-child"></div>
                    <div class="sk-circle12 sk-child"></div>
                </div>
                <!-- <div class="loader-loading">
                    <span class="loading-text">Loading</span>
                    <div class="dot-pulse"></div>
                </div> -->
            </div>
        </div>

            @include('layout.sidebar')

            <div class="main-content-section contact-us">
                <h2>Contact Us</h2>
                <div class="main-content-section-inner">
                    <h4>How may we help you?</h4>
                    <div class="two-sections">
                        <div class="left-section">
                            <ul class="left-listing">
                                <li class="list">
                                    <div class="list-upper">
                                        <img src="{{ asset('assets/images/contact-us/location.png') }}" alt="list">
                                        <span>Address</span>
                                    </div>
                                    <p>1201 US Hwy 1, Suite 305C, North Palm Beach, FL 33408</p>
                                </li>
                                <li class="list">
                                    <div class="list-upper">
                                        <img src="{{ asset('assets/images/contact-us/phone.png') }}" alt="list">
                                        <span>Call for queries</span>
                                    </div>
                                    <p>734-697-2907<br> 843-971-1906</p>
                                </li>
                                <li class="list">
                                    <div class="list-upper">
                                        <img src="{{ asset('assets/images/contact-us/email.png') }}" alt="list">
                                        <span>Call for queries</span>
                                    </div>
                                    <p>Email Us</p>
                                </li>
                            </ul>
                        </div>

                        <div class="right-section">
                        <span id="msg"></span>
                            <form id="contactForm" name="contactForm">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contactName" aria-describedby="emailHelp" placeholder="Full Name" value="{{ Auth::user()->name }}" name="contactName">
                                    <div class="text-danger">{{ $errors->first('contactName') }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contactEmail" aria-describedby="emailHelp" placeholder="Email Address" value="{{ Auth::user()->email }}" name="contactEmail" >
                                    <div class="text-danger">{{ $errors->first('contactEmail') }}</div>

                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" id="contactMessage" aria-describedby="emailHelp" placeholder="Message" name="contactMessage"></textarea>
                                    <div class="text-danger">{{ $errors->first('contactMessage') }}</div>

                                </div>
                                <button type="button" class="submit-btn btn" id="contactButton">Submit</a>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        // app url for global search
        var app_url = "{{ env('APP_URL') }}"

        $(document).ready(function() {
            AOS.init();
        });
        $(document).ready(function() {
            $("#contactForm").validate({
                rules: {
                    contactEmail: {
                        required: true,
                        email: true
                    },
                    contactName: {
                        required: true,
                    },
                    contactMessage:{
                        required:true
                    }
                },
                messages: {

                    contactEmail: {
                        required: "Please specify your email",
                        email: "Please enter valid email",
                    },
                    contactName: {
                        required: "Please enter your name"
                    },
                    contactMessage:{
                        required: "Please enter message"
                    }
                }
            })
        });
        $('#contactButton').click(function() {
            $('.loader').show();
            $("#contactForm").valid();
            if (!$("#contactForm").valid()) {
                $('.loader').hide();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/contact_us') }}",
                    type: "POST",
                    data: $('#contactForm').serialize(),
                    success: function(response) {
                        response=JSON.parse(response);
                        console.log("response".response);
                        if (response == 1) {
                            $('.loader').hide();

                            $('#msg').html('Thankyou for your feedback');
                            $('#contactMessage').val('');
                        } else {
                            $('.loader').hide();

                            // $('.loader').hide();
                            var validator = $("#contactForm").validate();
                            var objErrors = {};
                            objErrors['contactMessage'] = "Something went wrong";
                            validator.showErrors(objErrors);
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();

                        // $('.loader').hide();
                        var validator = $("#contactForm").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                });
        });
    </script>
</body>
</html>