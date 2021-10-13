<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/faq.css') }}" type="text/css" rel="stylesheet" media="screen" />

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
            body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
            }

            * {
            box-sizing: border-box;
            }

            .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
            }

            .col-25 {
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
            }

            .col-50 {
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
            }

            .col-75 {
            -ms-flex: 75%; /* IE10 */
            flex: 75%;
            }

            .col-25,
            .col-50,
            .col-75 {
            padding: 0 16px;
            }

            .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
            }

            input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
            }

            label {
            margin-bottom: 10px;
            display: block;
            }

            .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
            }

            .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
            }

            .btn:hover {
            background-color: #45a049;
            }

            a {
            color: #2196F3;
            }

            hr {
            border: 1px solid lightgrey;
            }

            span.price {
            float: right;
            color: grey;
            }

            /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
            @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }
            .col-25 {
                margin-bottom: 20px;
            }
            }
</style>
</head>
@include('layout.favicon')
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">
            <div class="col-50">
                <h3>Payment</h3>
                <span id="msg"></span>
                <!-- <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div> -->
                <form name="paymentForm" id="paymentForm">
                    @csrf
                    <div class="form-group">
                         <label for="cname">Name on Card</label>
                        <input type="text" class="form-control" id="cardname" name="cardname" placeholder="John More Doe">
                        <div class="text-danger">{{ $errors->first('cardname') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="cardnumber"  class="form-control" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <div class="text-danger">{{ $errors->first('cardnumber') }}</div>
                    </div>
                    <div class="form-group">
                         <label for="expmonth">Exp Month</label>
                         <input type="text" class="form-control" id="expmonth" name="expmonth" placeholder="September">
                         <div class="text-danger">{{ $errors->first('expmonth') }}</div>
                    </div>
                         <div class="row">
                    <div class="col-50" class="form-group">
                        <label for="expyear">Exp Year</label>
                        <input type="text" class="form-control" id="expyear" name="expyear" placeholder="2018">
                        <div class="text-danger">{{ $errors->first('expyear') }}</div>
                    </div>
                    <div class="col-50"  class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="352">
                        <div class="text-danger">{{ $errors->first('cvv') }}</div>
                    </div>
                    <button type="button" value="Continue to checkout"  id="paymentButton" class="btn">
                </form>
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
            $("#paymentForm").validate({
                rules: {
                    cardnumber: {
                        required: true,
                        minlength:16,
                        maxlength:16,
                        number:true
                    },
                    cardname: {
                        required: true,
                    },
                    expmonth:{
                        required:true,
                        number: true,
                        range: [1, 12],
                        digits: true
                    },
                    expyear:{
                        required:true,
                        checkYear:true
                    },
                    cvv:{
                        required:true
                    },
                    

                },
                messages: {

                    cardnumber: {
                        required: "Please enter your card number",
                        minlength:"Card number must be of 16 length",
                        maxlength:"Card number must be of 16 length",
                        number:"Please enter digits only",
                    },
                    cardname: {
                        required: "Please enter your name on card"
                    },
                    expmonth:{
                        required: "Please enter expiry month",
                        number: "Please enter numbers only",
                        range: "Invalid month",
                        digits: "please enter digits only"
                    },
                    expyear:{
                        required: "Please enter expiry year",
                    },
                    cvv:{
                        required: "Please enter cvv"
                    }
                }
            });
        });
        $.validator.addMethod("checkYear", function(value, element) {
        var year = $("#expyear").val(); //why not $(element) ?!?
        console.log(parseInt(year, 10));
        return (new Date()).getFullYear() >= parseInt(year, 10);
        }, "Invalid year");
        $('#paymentButton').click(function() {
            // $('.loader').show();
            $("#paymentForm").valid();
            if (!$("#paymentForm").valid()) {
                // $('.loader').hide();
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/checkout') }}",
                    type: "POST",
                    data: $('#paymentForm').serialize(),
                    success: function(response) {
                        // response=JSON.parse(response);
                        console.log("response"+response);
                        if (response == 1) {
                            // $('.loader').hide();

                            $('#msg').html('Your card is saved successfully');
                            // $('#contactMessage').val('');
                        } else if(response==0){
                            // $('.loader').hide();

                            var validator = $("#paymentForm").validate();
                            var objErrors = {};
                            objErrors['cvv'] = "Something went wrong";
                            validator.showErrors(objErrors);
                        }else{
                            $('#msg').html("Something went wrong");
                        }
                    },
                    error: function(error) {
                        // $('.loader').hide();

                        // $('.loader').hide();
                        var validator = $("#paymentForm").validate();
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