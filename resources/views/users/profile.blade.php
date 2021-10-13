<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/my-profile.css') }}" type="text/css" rel="stylesheet" media="screen" />

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
    {{-- <style type="text/css" src="{{asset('assets/css/common.css')}}" ></style>--}}
</head>
@include('layout.favicon')
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">

            @include('layout.sidebar')

            <div class="main-content-section profile-page">
                <h2>My Profile</h2>
                <div class="main-content-section-inner">
                    <div class="main-content-section-left">
                        <div class="profile-box">
                            {{-- Profile Image --}}
                            <img class="profile_picture" src="{{ file_exists(public_path('assets/images/profile/profile_images/' . Auth::user()->id . '/' . Auth::user()->image_path)) ? asset('assets/images/profile/profile_images/' . Auth::user()->id . '/' . Auth::user()->image_path) : 'assets/images/profile/profile.png' }}" alt="{{ Auth::user()->name }}" height="231" width="231">
                            <span class="camera-img" id="upload_image" style="cursor:pointer;">
                                <form id="profile_image_upload" action="{{ env('APP_URL') }}/upload_profile_image" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <img onclick="document.getElementById('attachment').click()" id="btnAttachment" value="File" src="{{ asset('assets/images/profile/camera.png') }}" alt="camera">
                                    <input type="file" name="profile_image" class="file" id="attachment" style="display: none;" onchange="fileSelected(this)" />
                                </form>
                            </span>
                            {{-- <input type="file" name="image" class="profile_image" style="display: none"> --}}
                            <div class="text-danger" style="font-size: 14px;width: 165px;">
                                {{ $errors->first('profile_image') }}</div>
                        </div>
                    </div>
                    <div class="main-content-section-right">
                        <div class="main-content-section-right-inner">
                            <h2>Contact and Sign-in Information</h2>
                            {{-- profile name --}}
                            <div class="form-group mb15">
                                <label for="profile_name">Name:</label>
                                <input type="text" class="form-control" id="profile_name" aria-describedby="emailHelp" value="{{ Auth::user()->name ?? 'Your Name' }}" disabled>
                                <img class="pencil-icon" id="edit_name" src="{{ asset('assets/images/profile/pencil.png') }}" alt="pencil">
                                <img class="save-icon" id="save_name" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none">
                            </div>
                            {{-- Div to show the name validation errors --}}
                            <div class="text-danger" id="show_name_validation" style="display: none">
                                <span id="name_validation_error"> Error Messages </span>
                            </div>

                            {{-- dob --}}
                            <div class="form-group mb15">
                                <label for="profile_dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="profile_dob" aria-describedby="emailHelp" value="{{ Auth::user()->dob ?? '' }}" placeholder="mm/dd/yyyy" disabled>
                                <img class="pencil-icon" id="edit_dob" src="{{ asset('assets/images/profile/pencil.png') }}" alt="pencil">
                                <img class="save-icon" id="save_dob" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none">
                            </div>
                            {{-- Div to show the dob validation errors --}}
                            <div class="text-danger" id="show_dob_validation" style="display: none">
                                <span id="dob_validation_error"> Error Messages </span>
                            </div>

                            {{-- email --}}
                            <div class="form-group mb15 disabled">
                                <label for="profile_email">Email:</label>
                                <input type="email" class="form-control" id="profile_email" placeholder="example@gmail.com" aria-describedby="emailHelp" value="{{ Auth::user()->email ?? '' }}" disabled>
                            </div>
                            {{-- Div to show the email validation errors --}}
                            <div class="text-danger" id="show_email_validation" style="display: none">
                                <span id="email_validation_error"> Error Messages </span>
                            </div>

                            {{-- phone --}}
                            <div class="form-group mb15">
                                <label for="profile_phone">Phone:</label>
                                <input type="text" class="form-control" placeholder="+1 7xx-xxx-xxxx" name="profile_phone" id="profile_phone" aria-describedby="emailHelp" value="{{ Auth::user()->phone_number ?? '' }}" disabled>
                                <img class="pencil-icon" id="edit_phone" src="{{ asset('assets/images/profile/pencil.png') }}" alt="pencil">
                                <img class="save-icon" id="save_phone" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none">
                            </div>
                            {{-- Div to show the phone validation errors --}}
                            <div class="text-danger" id="show_phone_validation" style="display: none">
                                <span id="phone_validation_error"> Error Messages </span>
                            </div>

                            {{-- password --}}
                            <div class="form-group mb15 password">
                                <label for="user_password">Password:</label>
                                <input type="password" class="form-control profile_password" placeholder="********" name="profile_password" id="profile_password" aria-describedby="emailHelp" disabled>
                                <span id="show_password"><i class="fa fa-fw fa-eye-slash field_icon eye" style="right: 100px;top: 22px;color:#2D7D00"></i></span>
                                <img class="pencil-icon" id="edit_password" src="{{ asset('assets/images/profile/pencil.png') }}" alt="pencil" id="edit_password">
                            </div>
                            {{-- Div to show the password validation errors --}}
                            <div class="text-danger" id="show_password_validation" style="display: none">
                                <span id="password_validation_error"> Error Messages </span>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="form-group mb15 password " id="confirm_password_div" style="display: none">
                                <label for="confirm_user_password">Confirm Password:</label>
                                <input type="password" class="form-control profile_password" id="confirm_profile_password" aria-describedby="emailHelp" placeholder="Repeat your password" disabled>
                                <span id="show_password1"><i class="fa fa-fw fa-eye-slash field_icon eye"
                                        style="right: 100px;top: 35px;color:#2D7D00;"></i></span>
                                {{-- <img class="pencil-icon" src="{{asset('assets/images/profile/pencil.png')}}" alt="pencil"> --}}
                                <img class="save-icon" id="save_profile_password" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none">
                            </div>
                            {{-- Div to show the password match errors --}}
                            <div class="text-danger" id="show_password_error" style="display: none">
                                <span id="password_match_error_message"> Error Messages </span>
                            </div>
                            <h2 class="mt52">Billing and Shipping 
                                <button class="new-card-btn" data-toggle="modal" data-target="#AddNewPopupModal">
                                    <span>+</span> Add New
                                </button>
                            </h2>
                            <!--Provider detail modal -->

                            <div class="modal fade mint-popup add-new-popup-modal" id="AddNewPopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> -->
                                        </div>
                                        <div class="modal-body">
                                            <div class="add-card-header">
                                                <h2 class="card-heading">Add New Card</h2>
                                            </div>
                                            <h2>Card Information</h2>
                                            <span id="msg"></span>
                                            <form  name="paymentForm" id="paymentForm"  action="{{ env('APP_URL') }}/checkout" method="post">
                                                @csrf
                                                <div class="form-group mb15">
                                                    <label for="exampleInputEmail">Card Number:</label>
                                                    <input type="text" id="cardnumber"  class="form-control" name="cardnumber"  placeholder="XXXX XXXX XXXX 2456" aria-describedby="emailHelp" value="" >
                                                    <div class="text-danger">{{ $errors->first('cardnumber') }}</div>
                                                </div>
                                                <div class="form-group mb15">
                                                    <label for="exampleInputPhone">Holder Name:</label>
                                                    <input type="text"  id="cardname" name="cardname" class="form-control" placeholder="Mabel perkins" aria-describedby="emailHelp" value="" >
                                                    <div class="text-danger">{{ $errors->first('cardname') }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group mb15">
                                                        <label for="exampleInputPhone">Expiry Month:</label>
                                                        <input type="text" class="form-control"  id="expmonth" name="expmonth" placeholder="04" aria-describedby="emailHelp" value="" >
                                                        <div class="text-danger">{{ $errors->first('expmonth') }}</div>
                                                    </div>
                                                    <div class="form-group mb15">
                                                        <label for="exampleInputPhone">Expiry Year:</label>
                                                        <input type="text" class="form-control"  id="expyear" name="expyear" placeholder="2021" aria-describedby="emailHelp" value="" >
                                                        <div class="text-danger">{{ $errors->first('expyear') }}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb15">
                                                        <label for="exampleInputPhone">CVV:</label>
                                                        <input type="text" class="form-control" id="cvv" name="cvv"  placeholder="***" aria-describedby="emailHelp" value="" >
                                                        <div class="text-danger">{{ $errors->first('cvv') }}</div>
                                                    </div>
                                                <div class="mb15">
                                                    <button type="button" id="paymentButton" class="save-btn btn">Save</button>
                                                </div> 
                                            </form>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button>
                                            <button type="button" id="logoutButton" class="btn btn-primary modal-btn">Logout</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            {{-- Payment method --}}
                            <div class="form-group mb15 paymentLabel">
                                <label for="exampleInputPayment">Payment Method:</label>
                                <div class="cardMain">
                                @if(!empty($visaDetails))
                                    @foreach($visaDetails as $detail)
                                    <div class="cardClasses">
                                        @if(strtolower($detail->card_type)=='visa')
                                            <img class="visa-img" src="{{ asset('assets/images/profile/visa.png') }}" alt="visa">
                                        @endif
                                        <input type="text" class="form-control" id="exampleInputPayment" aria-describedby="emailHelp" value="X X X X X {{ $detail->card_number ?? '' }}" >
                                        <!-- <img class="pencil-icon" src="{{ asset('assets/images/profile/pencil.png') }}"  data-toggle="modal"  data-todo='{{$detail}}'data-target="#EditCardPopupModal" onclick="openEditCard('{{$detail}}')" alt="pencil"> -->
                                        <!-- <img class="save-icon" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none"> -->
                                    </div>
                                    <div id="recentAddedCard" class="cardClasses" style="display:none;">
                                        <img class="visa-img" src="{{ asset('assets/images/profile/visa.png') }}" alt="visa" id="recentCardImage" style="display:none;">
                                        <input type="text" class="form-control" id="recentCardNumber" aria-describedby="emailHelp" value="" >
                                    </div>
                                    <div class="modal fade mint-popup add-new-popup-modal" id="EditCardPopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> -->
                                                </div>
                                                <div class="modal-body">
                                                    <div class="add-card-header">
                                                        <h2 class="card-heading">Edit Card</h2>
                                                    </div>
                                                    <h2>Card Information</h2>
                                                    <span id="editCardMsg"></span>
                                                    <form  name="editCardForm" id="editCardForm">
                                                        @csrf
                                                        <div class="form-group mb15">
                                                            <label for="exampleInputEmail">Card Number:</label>
                                                            <input type="text" id="editcardnumber"  class="form-control" name="editcardnumber"   aria-describedby="emailHelp" value="XXXX XXXX XXXX {{$detail->card_number}} ?? ''" >
                                                            <div class="text-danger">{{ $errors->first('editcardnumber') }}</div>
                                                        </div>
                                                        <div class="form-group mb15">
                                                            <label for="exampleInputPhone">Holder Name:</label>
                                                            <input type="text"  id="editcardname" name="editcardname" class="form-control"  aria-describedby="emailHelp" value="" >
                                                            <div class="text-danger">{{ $errors->first('editcardname') }}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group mb15">
                                                                <label for="exampleInputPhone">Expiry Month:</label>
                                                                <input type="text" class="form-control"  id="editexpmonth" name="editexpmonth"  aria-describedby="emailHelp" value="" >
                                                                <div class="text-danger">{{ $errors->first('editexpmonth') }}</div>
                                                            </div>
                                                            <div class="form-group mb15">
                                                                <label for="exampleInputPhone">Expiry Year:</label>
                                                                <input type="text" class="form-control"  id="editexpyear" name="editexpyear" aria-describedby="emailHelp" value="" >
                                                                <div class="text-danger">{{ $errors->first('editexpyear') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb15">
                                                                <label for="exampleInputPhone">CVV:</label>
                                                                <input type="text" class="form-control" id="editcvv" name="editcvv"   aria-describedby="emailHelp" value="" >
                                                                <div class="text-danger">{{ $errors->first('editcvv') }}</div>
                                                            </div>
                                                        <div class="mb15">
                                                            <button type="button" id="editPaymentButton" class="save-btn btn">Save</button>
                                                        </div> 
                                                    </form>
                                                </div>
                                                <!-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button>
                                                    <button type="button" id="logoutButton" class="btn btn-primary modal-btn">Logout</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>

                            {{-- address --}}
                            <div class="form-group mb15">
                                <label for="shipping_address">Shipping Address:</label>
                                <input type="text" class="form-control" id="shipping_address" aria-describedby="emailHelp" placeholder="Your Address" value="{{ $address->formatted_address ?? '' }}" disabled>
                                <img class="pencil-icon" id="edit_shipping_address" src="{{ asset('assets/images/profile/pencil.png') }}" alt="pencil">
                                <img class="save-icon" id="save_shipping_address" src="{{ asset('assets/images/profile/save.png') }}" alt="save" style="display: none">
                            </div>
                            
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

        // File Upload Part for profile image
        function openAttachment() {
            document.getElementById('attachment').click();
        }

        function fileSelected(input) {
            // alert(input.files[0].name);
            $('#btnAttachment').val(input.files[0].name);
            $('#profile_image_upload').ajaxForm({
                success: function(response) {
                    var path = JSON.parse(response);
                    $('.profile_picture').attr("src", path);
                }
            }).submit();
        }

        // Main function to save the details
        function save_details(input_field_id, db_column_name) {
            // for name
            if (db_column_name == 'name') {
                console.log('name working');

                var name = $('#profile_name').val();
                // Validations

                var data = {
                    "_token": '{{ csrf_token() }}',
                    "name": name
                }
            }

            // for dob
            else if (db_column_name == 'dob') {
                console.log('dob working');

                var dob = $('#profile_dob').val();
                // Validations

                var data = {
                    "_token": '{{ csrf_token() }}',
                    "dob": dob
                }
            }
            // for email


            // for phone
            else if (db_column_name == 'phone_number') {
                console.log('phone working');

                var phone = $('#profile_phone').val();

                // Validations
                phone = phone.replace(/\s+/g, '');
                console.log(phone[1]);
                var count = phone.length;
                var number = $.isNumeric(phone);
                if (count != 10) {
                    $('#show_phone_validation').show();
                    $('#phone_validation_error').html('Phone number must be of 10 digits');
                } else if (number == false) {
                    $('#show_phone_validation').show();
                    $('#phone_validation_error').html('Phone number must be numeric');
                }
                else {
                    console.log("hii");
                    $('#show_phone_validation').hide();
                    // disable input field
                    $("#profile_phone").prop('disabled', true);
                    $("#edit_phone").show();
                    $("#save_phone").hide();

                    // working
                    var newPhone = $('#profile_phone').val();
                    var data = {
                        "_token": '{{ csrf_token() }}',
                        "phone_number": newPhone
                    }
                }
            }

            // for password
            else if (db_column_name == 'password') {
                console.log('password working');

                var password = $('#profile_password').val();
                var confirm_password = $('#confirm_profile_password').val();

                // Validations
                if (password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/)) {
                    var password_check = true;
                }
                if (password != confirm_password) {
                    var password_match = false;
                    $('#password_match_error_message').html('Password does not match');
                    $('#show_password_error').show();
                }
                if (password_check != true) {
                    $('#password_validation_error').html(
                        'Password must be minimum 8 characters, at least one small alphabet , at least one capital alphabet, one number and one special character'
                        );
                    $('#show_password_validation').show();
                }
                if (password_match != false && password_check == true) {
                    $('#show_password_error').hide();
                    //  $("#save_profile_password").show();

                    $('#show_password_error').hide();
                    $('#show_password_validation').hide();
                    $("#confirm_profile_password").prop('disabled', false);
                    $("#profile_password").prop('disabled', false);
                    $("#edit_password").toggle();
                    $("#save_profile_password").hide();
                    $('#confirm_password_div').toggle();
                    var data = {
                        "_token": '{{ csrf_token() }}',
                        "password": password
                    }
                }
            }

            // for payment method
            // for shipping
            else if (db_column_name == 'formatted_address') {
                console.log('address working');

                var address = $('#shipping_address').val();
                // Validations

                var data = {
                    "_token": '{{ csrf_token() }}',
                    "formatted_address": address
                }
            }
            // Outside if else calling update
            update(data);
        }
        $('#show_password').click(function() {
            if ($('#profile_password').attr('type') === 'password') {
                $('#profile_password').attr('type', 'text');
                $('#show_password i').addClass("fa-eye");
                $('#show_password i').removeClass("fa-eye-slash");
            } else {
                $('#profile_password').attr('type', 'password');
                $('#show_password i').addClass("fa-eye-slash");
                $('#show_password i').removeClass("fa-eye");
            }
        });
        $('#show_password1').click(function() {
            if ($('#confirm_profile_password').attr('type') === 'password') {
                $('#confirm_profile_password').attr('type', 'text');
                $('#show_password1 i').addClass("fa-eye");
                $('#show_password1 i').removeClass("fa-eye-slash");
            } else {
                $('#confirm_profile_password').attr('type', 'password');
                $('#show_password1 i').addClass("fa-eye-slash");
                $('#show_password1 i').removeClass("fa-eye");
            }
        });
        // Update function to save data in the database
        function update(data_array) {
            var url = "{{ env('APP_URL') . '/update' }}"
            $.ajax({
                url: url,
                type: 'post',
                data: data_array,
                success: function(response) {
                    var response = JSON.parse(response);
                    console.log($response);
                }
            });
        }

        $(document).ready(function() {
            AOS.init();

            // To update profile in the database
            $('#upload_image').click(function() {
                $('.profile_image').toggle();
            });

            // Script for saving the name
            $("#edit_name").click(function() {
                // enable input field
                $("#profile_name").prop('disabled', false);
                $("#edit_name").toggle();
                $("#save_name").toggle();
            });
            $("#save_name").click(function() {
                // disable input field
                $("#profile_name").prop('disabled', true);
                $("#edit_name").toggle();
                $("#save_name").toggle();

                // updating name
                var input_field_id = '#profile_name';
                var db_column_name = 'name';
                // Calling common function to save details
                save_details(input_field_id, db_column_name);
            });

            // Script for saving the date of birth
            $("#edit_dob").click(function() {
                // enable input field
                $("#profile_dob").prop('disabled', false);
                $("#edit_dob").toggle();
                $("#save_dob").toggle();
            });
            $("#save_dob").click(function() {
                // disable input field
                $("#profile_dob").prop('disabled', true);
                $("#edit_dob").toggle();
                $("#save_dob").toggle();

                // updating dob
                var input_field_id = '#profile_dob';
                var db_column_name = 'dob';
                // Calling common function to save details
                save_details(input_field_id, db_column_name);
            });

            // Script for saving the email
            // not yet ready

            // Script for saving the phone number
            $("#edit_phone").click(function() {
                // enable input field
                $("#profile_phone").prop('disabled', false);
                $("#edit_phone").hide();
                $("#save_phone").show();
            });
            $("#save_phone").click(function() {

                // callingn update function to save phone number
                var input_field_id = '#profile_phone';
                var db_column_name = 'phone_number';
                // Calling common function to save details
                save_details(input_field_id, db_column_name);

            });

            // To Update the password
            $('#edit_password').click(function() {
                $("#profile_password").prop('disabled', false); // Enabling to be writable
                $("#edit_password").toggle();
                $("#save_profile_password").toggle();
                $('#confirm_password_div').toggle(); // Showing confirm password
                $("#confirm_profile_password").prop('disabled', false); // Enabling to be writable
            });
            // saving the password
            $("#save_profile_password").click(function() {
                var input_field_id = '#profile_password';
                var db_column_name = 'password';
                // Calling common function to save details
                save_details(input_field_id, db_column_name);

            });

            // Script for saving the address
            $("#edit_shipping_address").click(function() {
                // enable input field
                $("#shipping_address").prop('disabled', false);
                $("#edit_shipping_address").toggle();
                $("#save_shipping_address").toggle();
            });
            $("#save_shipping_address").click(function() {
                // disable input field
                $("#shipping_address").prop('disabled', true);
                $("#edit_shipping_address").toggle();
                $("#save_shipping_address").toggle();

                // updating address
                var input_field_id = '#profile_address';
                var db_column_name = 'formatted_address';
                // Calling common function to save details
                save_details(input_field_id, db_column_name);
                // update();
            });
            $("#paymentForm").validate({
                rules: {
                    cardnumber: {
                        required: true,
                        minlength:12,
                        maxlength:19,
                        number:true
                    },
                    cardname: {
                        required: true,
                    },
                    expmonth:{
                        required:true,
                    },
                    expyear:{
                        required:true
                    },
                    cvv:{
                        required:true
                    },
                    

                },
                messages: {

                    cardnumber: {
                        required: "Please enter your card number",
                        minlength:"Card number must be of 12 length",
                        maxlength:"Card number must be of 19 length",
                        number:"Please enter digits only",
                    },
                    cardname: {
                        required: "Please enter your name on card"
                    },
                    expmonth:{
                        required: "Please enter expiry month"
                    },
                    expyear:{
                        required: "Please enter expiry year"
                    },
                    cvv:{
                        required: "Please enter cvv"
                    }
                }
            });
             $('#paymentButton').click(function() {
           
            $("#paymentForm").valid();
                if (!$("#paymentForm").valid()) {
                
                        return false;
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#paymentForm').ajaxForm({
                        // url: "{{ URL::to('/checkout') }}",
                        // type: "POST",
                        // data: $('#paymentForm').serialize(),
                        success: function(response) {
                            console.log("response"+response);
                            // response=JSON.parse(response);
                            if (response != 0) {
                                console.log(response);
                                $('#msg').html('Your card is saved successfully');
                                $('#recentAddedCard').show();
                                if(response['card_type'].toLowerCase()=='visa'){
                                    $('#recentCardImage').show();
                                }
                                $('#recentCardNumber').val('XXXX XXXX XXXX '+response['card_number']);
                             
                                $('#AddNewPopupModal').hide();
                                $('#paymentForm :input').val('');
                                $('#msg').html('');
                                // $("#paymentForm").reload();
                                $("input[name=token]").val(response.token); // NEW              
                                load();
                            } else if(response==0){
                                var validator = $("#paymentForm").validate();
                                var objErrors = {};
                                objErrors['cvv'] = "Something went wrong";
                                validator.showErrors(objErrors);
                            }else{
                                $('#msg').html("Something went wrong");
                            }
                        },
                        error: function(error) {;
                            var validator = $("#paymentForm").validate();
                            var objErrors = {};
                            for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                                objErrors[key] = value[0];
                            }
                            validator.showErrors(objErrors);
                        },
                    }).submit();
                });
            });
            function openEditCard(data){
                console.log(data);
                $.ajax({
                type: "GET",
                url: "{{ URL::to('/getCardDetails') }}",
                data: {
                _method: 'GET',
                'stripe_customer_id': data['customer_stripe_id']
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                // $("#exampleModal").modal("show");
                },
                error: function (jqXHR, exception) {
                console.log(jqXHR.responseText);
                }
                });
            
            }
    </script>
</body>
</html>
