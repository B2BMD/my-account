<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orders</title>
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
                <h2>Orders <div class="test-btns">
                        <div class="search-bar">
                            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                        </div>
                    </div>
                </h2>
                <div class="main-content-section-inner order-detail">
                    <div class="main-content-section-upper">
                        <div class="main-content-section-left">
                            <div class="main-content-section-left-inner">
                                <h2><span class="main">
                                    <a href="{{ env('APP_URL') }}/orders">
                                    <img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow">Contrave, 10mg</span></a>
                                    <span class="sub">
                                        <span class="dot"></span>Pending Order</span>
                                </h2>
                                <div class="two-sections">
                                    <div class="left-section">
                                        <img src="{{ asset('assets/images/orders/med-03.png') }}" alt="image">
                                    </div>
                                    <div class="right-section">
                                        <p>Custom weight loss treatment plan. 2 months supply, taken twice daily.</p>
                                        <span class="price">$ 36.99</span>
                                        <div class="label-tag">
                                            <label>Quantity</label>
                                            <a class="btn green-btn" href="javascript:void(0)">1 pcs/ month</a>
                                        </div>
                                        <div class="buttons">
                                            <a class="btn blue" href="javascript:void(0)">Manage Prescription</a>
                                            <a class="btn white" href="javascript:void(0)">Cancel Order</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-content-section-right">
                            <div class="main-content-section-right-inner">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769506606!2d2.277020441486908!3d48.858950680702144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sen!2sin!4v1621254467456!5m2!1sen!2sin" width="389" height="393" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                <div class="shipped">
                                    <p class="green-time">Today, 10:00 AM</p>
                                    <div class="heading">
                                        <h4>Shipped <span>New York Store</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="track">
                        <h2>Track your order #12345678</h2>
                        <div class="destiny">
                            <div class="line">
                                <ul id="progressbar" class="text-center ">
                                    <div class="progress-line"></div>
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                            <h4>Order Signed</h4>
                                            <p>New York Store</p>
                                        </div>
                                        <div class="bottom-content bar-content">
                                            <p>20/18</p>
                                            <span>10:00 AM</span>
                                        </div>
                                    </li>
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                            <h4>Order Processed</h4>
                                            <p>New York Store</p>
                                        </div>
                                        <div class="bottom-content bar-content">
                                            <p>20/18</p>
                                            <span>10:00 AM</span>
                                        </div>
                                    </li>
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                            <h4>Shipped</h4>
                                            <p>New York Store</p>
                                        </div>
                                        <div class="bottom-content bar-content">
                                            <p>20/18</p>
                                            <span>10:00 AM</span>
                                        </div>
                                    </li>
                                    <li class="step0">
                                        <div class="upper-content bar-content">
                                            <h4>Out for delivery</h4>
                                            <p>San Francisco</p>
                                        </div>
                                        <div class="bottom-content bar-content">
                                            <p>20/18</p>
                                            <span>10:00 AM</span>
                                        </div>
                                    </li>
                                    <li class="step0">
                                        <div class="upper-content bar-content">
                                            <h4>Delivered</h4>
                                            <p>San Francisco</p>
                                        </div>
                                        <div class="bottom-content bar-content">
                                            <p>20/18</p>
                                            <span>10:00 AM</span>
                                        </div>
                                    </li>
                                </ul>
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