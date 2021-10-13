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
                            <!-- <a class="btn white" href="https://medicalweightlosscentersofamerica.com/shop/" target="_blank">Add new order</a> -->
                            <div class="search-bar">
                                <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                                <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                            </div>
                        </div>
                    </h2>
                    @if(!empty($pendingOrders))
                        <div class="main-content-section-inner completed-orders">
                            <h2><span class="main"><a href="{{ env('APP_URL') }}/orders">
                                <img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow"> Pending orders </a></span>
                            </h2>
                        
                            <ul class="completed-orders-listing">
                            
                                @foreach($pendingOrders as $order)
                                    <li class="completed-orders-list">
                                        <div class="completed-orders-left">
                                        @if(!empty($order->image_url))
                                            <img src="{{$order->image_url}}" style="height: 156px;width: 156px;border-radius:11px;">
                                        @else
                                            <img src="{{ asset('assets/images/orders/med-03.png') }}" alt="image">
                                        @endif
                                        </div>
                                        <div class="completed-orders-right">
                                            <h5>{{$order->line_items[0]->name?$order->line_items[0]->name:''}}</h5>
                                            @if(!empty($order->id))
                                                <a href="{{route('view_order', ['order_id' => $order->id])}}">Order No. {{$order->id?$order->id:''}}</a>
                                            @endif
                                            <ul class="description">
                                                <li class="description-list">
                                                    <label>Total</label>
                                                    <span class="label-name">$ {{$order->total?$order->total:''}}</span>
                                                </li>
                                                <li class="description-list">
                                                    <label>Order placed</label>
                                                    <span class="label-name">{{$order->date_created ? date('Y-m-d',strtotime($order->date_created)):''}}</span>
                                                </li>
                                            </ul>
                                            <div class="buttons">
                                                <!-- <a class="btn blue" href="javascript:void(0)">Refill</a> -->
                                                <a class="btn green" href="javascript:void(0)">Cancel order</a>
                                                <a class="btn green" href="{{route('view_order', ['order_id' => $order->id])}}">View details</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        
                        </div>
                    @endif
                    
               
                @if(!empty($completedOrders))
                    <div class="main-content-section-inner completed-orders">
                            <h2><span class="main"><a href="{{ env('APP_URL') }}/orders">
                                <img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow"> Completed orders </a></span>
                            </h2>
                        
                            <ul class="completed-orders-listing">
                            
                                @foreach($completedOrders as $order)
                                    <li class="completed-orders-list">
                                        <div class="completed-orders-left">
                                        @if(!empty($order->image_url))
                                            <img src="{{$order->image_url}}" style="height: 156px;width: 156px;border-radius:11px;">
                                        @else
                                            <img src="{{ asset('assets/images/orders/med-03.png') }}" alt="image">
                                        @endif
                                        </div>
                                        <div class="completed-orders-right">
                                            <h5>{{$order->line_items[0]->name?$order->line_items[0]->name:''}}</h5>
                                            @if(!empty($order->id))
                                                <a href="{{route('view_order', ['order_id' => $order->id])}}">Order No. {{$order->id?$order->id:''}}</a>
                                            @endif
                                            <ul class="description">
                                                <li class="description-list">
                                                    <label>Total</label>
                                                    <span class="label-name">$ {{$order->total?$order->total:''}}</span>
                                                </li>
                                                <li class="description-list">
                                                    <label>Order placed</label>
                                                    <span class="label-name">{{$order->date_created ?date('Y-m-d',strtotime($order->date_created)):''}}</span>
                                                </li>
                                            </ul>
                                            <div class="buttons">
                                            @if(!empty($order->date_created))
                                                @php $afterOneYear=date("Y-m-d H:i:s", strtotime("+1 years", strtotime($order->date_created)));;
                                                                $currentDate=date('Y-m-d H:i:s',strtotime($order->date_created));
                                                @endphp
                                                @if(($afterOneYear>$currentDate) && (strtolower($order->status)=='completed'))
                                                    <a class="btn blue" href="javascript:void(0)">Refill</a>
                                                @endif
                                                <!-- <a class="btn green" href="javascript:void(0)">Renew order</a> -->
                                                <a class="btn green" href="{{route('view_order', ['order_id' => $order->id])}}">View details</a>
                                            @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        
                    </div>
                @endif
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