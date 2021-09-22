<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create an account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    <section class="registration-content create">
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
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login">
                <img src="{{ env('APP_LOGO') }}" alt="logo">
            </a>
        </nav>
        <div class="heading">Create an account</div>
        <form id="form1" name="form1">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="sign_up_name" id="sign_up_name" aria-describedby="nameHelp">
                <div class="text-danger">{{ $errors->first('sign_up_name') }}</div>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="sign_up_email" id="sign_up_email" aria-describedby="emailHelp">
                <div class="text-danger">{{ $errors->first('sign_up_email') }}</div>
            </div>

            <div class="form-group password">
                <input type="password" class="form-control" placeholder="Password" name="sign_up_password" id="sign_up_password">
                <div class="text-danger">{{ $errors->first('sign_up_password') }}</div>
                <span id="show_password"><i class="fa fa-fw fa-eye-slash field_icon eye"></i></span>
            </div>

            <div class="checkbox-box">
                <div class="form-group">
                    <label class="container" style="padding-left:0px">
                        <input type="checkbox" name="checkbox">
                        <br><br>
                        <div class="text-danger">{{ $errors->first('checkbox') }}</div>
                        <span class="checkmark" name="checkbox"></span>
                    </label>
                </div>
                I agree to the Terms of Service and Privacy Policy
            </div>
            <button type="button" id="button" class="btn large btn-primary">Register</button>
            <span class="bottom-text">Are you already a member? <a href="{{ env('APP_URL') }}/login" id="loginButton">Login.</a></span>
        </form>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        $(document).ready(function() {
            $("#form1").validate({
                rules: {
                    sign_up_name: {
                        required: true,
                        minlength: 3
                    },
                    sign_up_email: {
                        required: true,
                        email: true
                    },
                    sign_up_password: {
                        required: true,
                        minlength: 1
                    },
                    checkbox: {
                        required: true,
                    },
                },
                messages: {
                    sign_up_name: {
                        required: "Please specify your name",
                        minlength: "Name should be atleast 3 characters",
                    },
                    sign_up_email: {
                        required: "Please specify your email",
                        email: "Please enter valid email",
                        minlength: "Name should be atleast 3 characters"
                    },
                    sign_up_password: {
                        required: "Please enter your password",
                        minlength: "Password should be atleast 6 characters"
                    },
                    checkbox: {
                        required: "Please select Terms of Service and Privacy Policy"
                    },
                }
            })
            $('#loginButton').click(function() {
                $('.loader').show();
                $('.loader').addClass('loader-show');
            });

            // clicking on the submit or login button
            $(document).keypress(function(e) {
                if (e.which == 13) {
                    $('#button').click();
                }
            });

            $('#button').click(function() {
                $('.loader').show();
                $("#form1").valid();
                if (!$("#form1").valid()) {
                    $('.loader').hide();
                    return false;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/register') }}",
                    type: "POST",
                    data: $('#form1').serialize(),
                    success: function(response) {
                        console.log("response".response);
                        if (response == "0") {
                            location.replace("{{ URL::to('/login') }}")
                        } else {
                            // $('.loader').hide();
                            // var validator = $("#loginForm").validate();
                            // var objErrors = {};              
                            // objErrors['sign_up_email'] = response.errors.sign_up_email;
                            // validator.showErrors(objErrors);
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        console.debug(error.responseJSON.errors);
                        var validator = $("#form1").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                });
            });
            $('#show_password').click(function() {

                if ($('#sign_up_password').attr('type') === 'password') {
                    $('#sign_up_password').attr('type', 'text');
                    $('#show_password i').addClass("fa-eye");
                    $('#show_password i').removeClass("fa-eye-slash");
                } else {
                    $('#sign_up_password').attr('type', 'password');
                    $('#show_password i').addClass("fa-eye-slash");
                    $('#show_password i').removeClass("fa-eye");
                }
            });
        });
    </script>
</body>
</html>
