<!DOCTYPE html>
<html lang="en">
<head>
    <title>Billing Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/orders.css') }}" type="text/css" rel="stylesheet" media="screen" />

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

            @include('layout.sidebar')

            <div class="main-content-section test-page">
                <h2>Orders <div class="test-btns"><a class="btn white" href="javascript:void(0)">Add new order</a>
                        <div class="search-bar">
                            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                        </div>
                    </div>
                </h2>
                <div class="main-content-section-inner billing-details">
                    <h2><span class="main"><img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow">Billing Details</span>
                    </h2>
                    <div class="billing-details-inner">
                        <div class="one-row">
                            <div class="form-group">
                                <label for="exampleInputName">First Name</label>
                                <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" value="Sallie">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastName">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputlastName" aria-describedby="emailHelp" value="McKelly">
                            </div>
                        </div>

                        <div class="one-row">
                            <div class="form-group">
                                <label for="exampleInputName">Address</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                    <label class="form-check-label" for="exampleRadios1"> Saved Shipping Address: </label>
                                    <span>3102 Ingram Road, Greensboro, North Carolina. 27409</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <a class="btn green" href="javascript:void(0)"><span>+</span> Add new address</a>
                            </div>
                        </div>

                        <div class="one-row">
                            <div class="form-group">
                                <label for="exampleInputEmail">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="sallie.mckelly@mail.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhone">Phone number</label>
                                <input type="text" class="form-control" id="exampleInputPhone" aria-describedby="emailHelp" value="+5 781-644-3627">
                            </div>
                        </div>

                        <div class="one-row payment-method">
                            <div class="form-group">
                                <label for="exampleInputName">Payment method</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                    <label class="form-check-label" for="exampleRadios1"> Saved Payment method </label>
                                    <div class="bottom-part">
                                        <img src="{{ asset('assets/images/orders/visa.png') }}" alt="payment">
                                        <span>X X X X X 3548</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group second">
                                <div class="form-check">
                                    <img src="{{ asset('assets/images/orders/group1.png') }}" alt="payment">
                                </div>
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

        $(document).ready(function() {
            AOS.init();
        });
    </script>
</body>
</html>