<!DOCTYPE html>

<html lang="en">

<head>
    <title>Forgot password</title>
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
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login"><img src="{{ env('APP_LOGO') }}" alt="logo"></a>
        </nav>
        <div class="heading">Forgot password</div>
        <form id="sendOtpForm" name="sendOtpForm">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" id="email" name="email" aria-describedby="nameHelp">
                <div class="text-danger">{{ $errors->first('email') }}</div>
                <!-- <span class="error-text">This field is required.</span> -->
            </div>
            <button type="button" id="button" class="btn large btn-primary">Submit</button>
        </form>
    </section>
    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        $(document).ready(function() {
            $("#sendOtpForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {

                    email: {
                        required: "Please specify your email",
                        email: "Please enter valid email",
                    }
                }
            })
            $('#button').click(function() {
                $('.loader').show();
                $("#sendOtpForm").valid();
                if (!$("#sendOtpForm").valid()) {
                    $('.loader').hide();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //show loader, hide button
                $.ajax({
                    url: "{{ URL::to('/sendEmail') }}",
                    type: "POST",
                    data: $('#sendOtpForm').serialize(),
                    success: function(response) {
                        console.log("response".response);
                        if (response == 1) {
                            location.replace("{{ URL::to('/send_link') }}")
                        } else {
                            //show button, hide loader
                            $('.loader').hide();
                            var validator = $("#sendOtpForm").validate();
                            var objErrors = {};
                            objErrors['email'] = response;
                            validator.showErrors(objErrors);
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        console.debug(error.responseJSON.errors);
                        var validator = $("#sendOtpForm").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                });
            });
        });
    </script>
</body>
</html>