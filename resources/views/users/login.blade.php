<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login to your account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/registration.css') }}" type="text/css" rel="stylesheet" media="screen" />

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
<body>
    <section class="registration-content login">
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
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login"><img src="{{ env('APP_LOGO') }}" alt="logo"></a>
        </nav>
        <div class="heading">Login to your account</div>
        <form name="loginForm" id="loginForm">
            @csrf
            <div class="text-danger">{{ $errors->first('message') }}</div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-describedby="emailHelp">
                <div class="text-danger">{{ $errors->first('email') }}</div>
            </div>
            <div class="form-group password">
                <input type="password" class="form-control" placeholder="Password" name="password" id="login_password">
                <div class="text-danger">{{ $errors->first('password') }}</div>
                {{-- <img class="eye" id="show_password" src="{{asset('assets/images/registration/eye.png')}}" alt="eye"> --}}
                <span id="show_password"><i class="fa fa-fw fa-eye-slash field_icon eye"></i></span>
            </div>
            <div class="checkbox-box">
                <div class="form-group">
                    <label class="container">Keep me signed in
                        <input type="checkbox" name="remember_me_checkbox" id="remember_me_checkbox">
                        <span class="checkmark" name="remember_me_checkbox"></span>
                    </label>
                </div>
                <a class="forgot-password" id="forgotButton" href="{{ env('APP_URL') }}/forgot_password">Forgot
                    password?</a>
            </div>
            <button type="button" id="button" class="btn large btn-primary">Login</button>
            <span class="bottom-text">Not a member yet? <a href="{{ env('APP_URL') }}/signup" id="signupButton">Sign up.</a></span>
        </form>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {

                    email: {
                        required: "Please specify your email",
                        email: "Please enter valid email",
                        minlength: "Name should be atleast 3 characters"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password should be atleast 8 characters"
                    }
                }
            })
            // clicking on the submit or login button
            $(document).keypress(function(e) {
                console.log("fg" + e.which)
                if (e.which == 13) {
                    $('#button').click();
                }
            });

            // Loader
            $('#forgotButton ,#signupButton').click(function() {
                $('.loader').show();
                $('.loader').addClass('loader-show');
            });

            $('#button').click(function() {
                $('.loader').show();
                $("#loginForm").valid();
                if (!$("#loginForm").valid()) {
                    $('.loader').hide();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/signin') }}",
                    type: "POST",
                    data: $('#loginForm').serialize(),
                    success: function(response) {
                        console.log("response".response);
                        if (response == "1") {
                            location.replace("{{ URL::to('/visits') }}")
                        } else {
                            $('.loader').hide();
                            var validator = $("#loginForm").validate();
                            var objErrors = {};
                            objErrors['password'] = response;
                            validator.showErrors(objErrors);
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        var validator = $("#loginForm").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                });
            });
            $('#show_password').click(function() {

                if ($('#login_password').attr('type') === 'password') {
                    $('#login_password').attr('type', 'text');
                    $('#show_password i').addClass("fa-eye");
                    $('#show_password i').removeClass("fa-eye-slash");
                } else {
                    $('#login_password').attr('type', 'password');
                    $('#show_password i').addClass("fa-eye-slash");
                    $('#show_password i').removeClass("fa-eye");
                }
            });
        });
    </script>
</body>
</html>