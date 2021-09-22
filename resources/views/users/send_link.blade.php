<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verify otp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/registration.css" type="text/css') }}" rel="stylesheet" media="screen" />

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
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login"><img src="{{ env('APP_LOGO') }}" alt="logo"></a>
        </nav>
        <div class="heading">Verify Otp</div>
        <form id="verifyOtpForm" name="verifyOtpForm">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Otp" id="otp" name="otp"
                    aria-describedby="nameHelp">
                <div class="text-danger">{{ $errors->first('otp') }}</div>
                <!-- <span class="error-text">This field is required.</span> -->
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="user_email" id="user_email" value="" aria-describedby="nameHelp">
            </div>
            <button type="button" id="button" class="btn large btn-primary">Send otp</button>
        </form>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        $(document).ready(function() {
            $("#user_email").val(response.email);
            $("#verifyOtpForm").validate({
                rules: {
                    otp: {
                        required: true,
                    }
                },
                messages: {

                    otp: {
                        required: "Please specify your email",
                        minlength: 4,
                        maxlength: 4
                    }
                }
            })
            $('#button').click(function() {
                $("#verifyOtpForm").valid();
                if (!$("#verifyOtpForm").valid()) {
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/verify_otp') }}",
                    type: "POST",
                    data: $('#verifyOtpForm').serialize(),
                    success: function(response) {
                        console.log("response".response);
                        if (response == "1") {
                            location.replace("{{ URL::to('/login') }}")
                        }
                    },
                    error: function(error) {
                        console.debug(error.responseJSON.errors);
                        var validator = $("#verifyOtpForm").validate();
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