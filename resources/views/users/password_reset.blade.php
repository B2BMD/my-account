<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
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
            <a class="navbar-brand" href="#"><img src="{{ env('APP_LOGO') }}" alt="logo"></a>
        </nav>
        <div class="heading">Reset password</div>
        <!-- <p>Weight loss is a decrease in body weight resulting from either voluntary (diet, exercise) or involuntary
      (illness) circumstances. Most instances of weight loss arise due to the loss of body fat, but in cases of extreme
      or severe weight loss, protein and other substances in the body can also be depleted</p> -->
        <form name="resetPasswordForm" id="resetPasswordForm" action="{{ URL::to('/update_password') }}" method="POST">
            @csrf
            <div class="form-group password">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="nameHelp">
                <span id="show_password"><i class="fa fa-fw fa-eye-slash field_icon eye"></i></span>
                <div class="text-danger">{{ $errors->first('password') }}</div>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group password">
                <input type="password" class="form-control" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" aria-describedby="emailHelp">
                <span id="show_password1"><i class="fa fa-fw fa-eye-slash field_icon eye"></i></span>
                <div class="text-danger error" id="pasError">{{ $errors->first('confirmPassword') }}</div>
            </div>
            <button type="button" id="resetPasswordButton" class="btn large btn-primary">Save</button>
        </form>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

    <script>
        $(document).ready(function() {
            $("#resetPasswordForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirmPassword: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {

                    password: {
                        required: "Password is required",
                        minlength: "Password must have atleast 6 characters"
                    },
                    confirmPassword: {
                        required: "Confirm password is required",
                        minlength: "Confirm password must have atleast 6 characters"
                    }
                }
            })


            $('#resetPasswordButton').click(function() {
                $('.loader').show();
                $("#resetPasswordForm").valid();
                if (!$("#resetPasswordForm").valid()) {
                    $('.loader').hide();
                    return false;
                } else {
                    $("#resetPasswordForm").submit();
                }
            });


            /*  $('#resetPasswordButton').click(function() {
                 $("#resetPasswordForm").valid();
                 if(!$("#resetPasswordForm").valid()){
                   return false;
                 }
                 $.ajaxSetup({
                     headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                   url: "{{ URL::to('/update_password') }}" ,
                   type: "POST",
                   data: $('#resetPasswordForm').serialize(),
                   success: function( response ) {
                     console.log("response".response);
                     if(response.status == "1"){
                       // location.replace( "{{ URL::to('/login') }}")
                       $.redirect("{{ URL::to('/reset') }}",
                           {
                               msg: response.msg,
                           });
                     } else {
                       var validator = $("#resetPasswordForm").validate();
                       var objErrors = {};              
                       objErrors['password'] = response;
                       validator.showErrors(objErrors);
                     }
                   },
                   error: function( error){            
                     var validator = $("#resetPasswordForm").validate();
                     var objErrors = {};
                     for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                       objErrors[key] = value[0];
                     }
                     validator.showErrors(objErrors);
                   },
                 });
             }); */
            $('#show_password').click(function() {

                if ($('#password').attr('type') === 'password') {
                    $('#password').attr('type', 'text');
                    $('#show_password i').addClass("fa-eye");
                    $('#show_password i').removeClass("fa-eye-slash");
                } else {
                    $('#password').attr('type', 'password');
                    $('#show_password i').addClass("fa-eye-slash");
                    $('#show_password i').removeClass("fa-eye");
                }
            });
            $('#show_password1').click(function() {

                if ($('#confirmPassword').attr('type') === 'password') {
                    $('#confirmPassword').attr('type', 'text');
                    $('#show_password1 i').addClass("fa-eye");
                    $('#show_password1 i').removeClass("fa-eye-slash");
                } else {
                    $('#confirmPassword').attr('type', 'password');
                    $('#show_password1 i').addClass("fa-eye-slash");
                    $('#show_password1 i').removeClass("fa-eye");
                }
            });
            $('#password, #confirmPassword').on('keyup', function() {
                if ($('#password').val() != $('#confirmPassword').val()) {
                    $('#pasError').html('Password does not match');
                } else {
                    $('#pasError').html('');
                }
            });
        });
    </script>
</body>
</html>
