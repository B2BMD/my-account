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
        <div class="section-inner">

            @include('layout.sidebar')

            <div class="main-content-section test-page">
                <h2>Orders <div class="test-btns"><a class="btn white" href="https://medicalweightlosscentersofamerica.com/shop/" target="_blank">Add new order</a>
                        <div class="search-bar">
                            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                        </div>
                    </div>
                </h2>
                <div class="main-content-section-inner">
                    <div class="main-content-section-inner-scroller">
                        @if(empty($completedOrders) && empty($pendingOrders))
                            <h2>No orders found</h2>
                        @else
                            @if(!empty($completedOrders))
                                <h3>Completed orders<span class="view-all"><a id="viewAllButton" href="{{route('all_orders', ['slug' => 'completed'])}}"> View all <img src="{{ asset('assets/images/orders/icon.png') }}" alt="icon"></a></span>
                                </h3>
                                <ul class="orders-listing">
                                    @php $count=0; @endphp
                                    @foreach($completedOrders as $order)
                                        @php $count++ @endphp
                                        @if($count<=3)
                                            <li class="orders-list">
                                                @if(!empty($order->image_url))
                                                    <img src="{{$order->image_url}}" alt="med-01" style="height: 216px;width: 216px;border-radius:11px;">
                                                @else
                                                    <img src="{{ asset('assets/images/orders/med-01.png') }}" alt="med-01">
                                                @endif
                                                <span class="main">{{$order->line_items[0]->name?$order->line_items[0]->name:''}}</span>
                                                @if(!empty($order->id))
                                                    <a href="{{route('view_order', ['order_id' => $order->id])}}" class="sub">Order No. {{$order->id?$order->id:''}}</a>
                                                @endif
                                                </li>
                                        @endif
                                    @endforeach
                                
                                </ul>
                            @else
                                <h2>No orders found!!</h2>
                            @endif
                            @if(!empty($pendingOrders))
                                <h3 class="mt48">Pendings orders<span class="view-all">
                                    <a id="viewAllButton1" href="{{route('all_orders', ['slug' => 'processing'])}}" > View all <img src="{{ asset('assets/images/orders/icon.png') }}" alt="icon"></a></span>
                                </h3>
                                <ul class="orders-listing">
                                        <div id="initialOrders">
                                            @php $count=0; @endphp
                                            @foreach($pendingOrders as $order)
                                                @php $count++ @endphp
                                                @if($count<=3)
                                                    <li class="orders-list">
                                                    @if(!empty($order->image_url))
                                                    <img src="{{$order->image_url}}" alt="med-01" style="height: 216px;width: 216px;border-radius:11px;">
                                                    @else
                                                        <img src="{{ asset('assets/images/orders/med-01.png') }}" alt="med-01">
                                                    @endif
                                                        <span class="main">{{$order->line_items[0]->name?$order->line_items[0]->name:''}}</span>
                                                        @if(!empty($order->id))
                                                            <a class="sub" href="{{route('view_order', ['order_id' => $order->id])}}">{{$order->id?$order->id:''}}</a>
                                                        @endif
                                                        </li>
                                                @endif
                                            @endforeach
                                        </div>
                                
                                </ul>
                            @else
                                <h2>No orders found!!</h2>
                            
                            @endif
                        @endif
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
        $('#viewAllButton, #viewAllButton1').click(function(){
            $('.loader').show();
        })
    </script>
</body>
</html>