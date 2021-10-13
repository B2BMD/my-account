<!DOCTYPE html>
<html lang="en">
<head>
    <title>Completed Orders</title>
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
                <h2>Orders Details <div class="test-btns">
                        <div class="search-bar">
                            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                        </div>
                    </div>
                </h2>
                <div class="main-content-section-inner completed-orders">
                  <div class="main-order-details">
                      <p class="order-status">Order #401331 was placd on july,2021 and is currently processing</p>
                      <div class="order-detail-inner ">
                            <h2>Order details</h2>
                            <table class="order-deatil-table">
                              <tr>
                                  <td>Product</td>
                                  <td class="right">Total</td>
                              </tr>
                              <tr>
                                  <td>
                                      <div class="order-profile-inner">
                                        <img src="../../assets/images/orders/group.png" />
                                        <span>Intial weight loss consultation </span> * 1
                                      </div>
                                  </td>
                                  <td class="right">$49.00</td>
                              </tr>
                              <tfoot>
                                <tr>
                                    <td class="right foot-head">Subtotal:</td>
                                    <td class="right">$49.00</td>
                                </tr>
                                <tr>
                                    <td class="right foot-head">Shipping:</td>
                                    <td class="right">First rate</td>
                                </tr>
                                <tr>
                                    <td class="right foot-head">Payment method:</td>
                                    <td class="right">Cash on delivery</td>
                                </tr>
                                <tr>
                                    <td class="right foot-head">Total:</td>
                                    <td class="right">$49.00</td>
                                </tr>
                              </tfoot>
                            </table>
                      </div>
                      <div class="order-detail-inner ">
                            <h2>Customer details</h2>
                            <div><p>Email:</p>pancham@mintrx.co</div>
                            <div><p>Phone:</p>457845678</div>
                            <table class="order-deatil-table customer-deatil-table">
                                <thead>
                                    <tr>
                                        <th>Billing address</th>
                                        <th>Shipping address</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    <tr>
                                        <td>pancham bansal</td>
                                        <td>pancham bansal</td>
                                    </tr>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                    </tr>
                                    <tr>
                                        <td>4512C</td>
                                        <td>4512C</td>
                                    </tr>
                                    <tr>
                                        <td>North Palm Beach, FL 33408</td>
                                        <td>North Palm Beach, FL 33408</td>
                                    </tr>
                                </tbody>            
                            </table>
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