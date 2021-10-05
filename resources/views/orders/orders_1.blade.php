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
    <script type="text/javascript">
        function toggleDetails(){
            $('#destiny-hidden').toggleClass('hidden');
            if($('#destiny-hidden').hasClass('hidden')){
                $('#btn-toggle-details').text('Show details');
            } else {
                $('#btn-toggle-details').text('Hide details');
            }
        }
    </script>
</head>
@include('layout.favicon')
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">

            @include('layout.sidebar')

            <div class="main-content-section test-page">
                <h2><a href="{{ env('APP_URL') }}/orders">Orders</a> <div class="test-btns">
                        <div class="search-bar">
                            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                        </div>
                    </div>
                </h2>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <span class="sub pl-4 pt-2p5">
                                    <span class="dot"></span>
                                    {{$orderDetail->status ? ucwords($orderDetail->status) : ''}} Order
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="buttons">
                                    @if(!empty($orderDetail->date_created))
                                        @php $afterOneYear=date("Y-m-d H:i:s", strtotime("+1 years", strtotime($orderDetail->date_created)));;
                                                $currentDate=date('Y-m-d H:i:s',strtotime($orderDetail->date_created));
                                        @endphp
                                        @if(($afterOneYear>$currentDate) && (strtolower($orderDetail->status)=='completed'))
                                            <a class="btn blue" href="javascript:void(0)">Refill</a>
                                        @endif
                                    @endif
                                    @if(!empty($orderDetail->status) && strtolower($orderDetail->status)=='processing')
                                        <a class="btn white" href="javascript:void(0)">Cancel Order</a>
                                    @else
                                        <a class="btn white" href="javascript:void(0)">Renew Order</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content-section-inner order-detail">
                    <div class="main-content-section-upper">
                        @if(!empty($orderDetail))
                            <div class="main-content-section-left">
                                @foreach($orderDetail->line_items as $product)
                                    <div class="main-content-section-left-inner">
                                        <h2><span class="main">
                                            <img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow">{{$product->name?$product->name:''}}</span></a>
                                        </h2>
                                        <div class="two-sections">
                                            <div class="left-section">
                                                @if(!empty($product->image_url))
                                                    <img src="{{ $product->image_url }}" alt="image" style="width: 216px;height:216px;object-fit:cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/orders/med-03.png') }}" alt="image" style="width: 216px;height:216px;object-fit:cover;">
                                                @endif
                                            </div>
                                            <div class="right-section">
                                                @if(!empty($product->product_short_description))
                                                    {!! html_entity_decode($product->product_short_description) !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-9">
                                                <div class="row order-item-details">
                                                    <div class="col-6 py-2">
                                                        <label>Price: </label><text>{{$product->total ? '$'.$product->total:'N/A'}}</text>
                                                    </div>
                                                    <div class="col-6 py-2">
                                                        <label>Quantity: </label><text>{{$product->quantity ? $product->quantity : 'N/A'}}</text>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="main-content-section-right">
                            <div class="main-content-section-right-inner">
                                <?php
                                    $maps_key = env('GOOGLE_MAPS_EMBED_API_KEY');

                                     if (empty($orderDetail->tracking['tracking_history']['Summary']['Event'])) {
                                        $what = 'No tracking data';
                                        $when = date('F j, Y');
                                        $where = 'North Palm Beach, FL';
                                     } else {
                                        $what = $orderDetail->tracking['tracking_history']['Summary']['Event'];
                                        $when = $orderDetail->tracking['tracking_history']['Summary']['EventDate'] . ', ' . $orderDetail->tracking['tracking_history']['Summary']['EventTime'];
                                        $where = $orderDetail->tracking['tracking_history']['Summary']['EventCity'] . ', ' . $orderDetail->tracking['tracking_history']['Summary']['EventState'];
                                     }
                                    $q = strtr($where, [', ' => '+', ' ' => '+']);
                                ?>
                                <iframe id="map-iframe" src="https://www.google.com/maps/embed/v1/place?key={{$maps_key}}&q={{$q}}&zoom=7" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                <!-- <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  style="border:0; margin-top: -150px;"  src="https://maps.google.com/maps?f=l&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Walt+Disney+World+Resort&amp;aq=t&amp;sll=28.38545007745952, -81.56377744291994&amp;ie=UTF8&amp;ll=28.38545007745952, -81.56377744291994&amp;z=17&amp;om=0&amp;iwloc=addr&amp;iwd=0&amp;layer=0&amp;output=embed"></iframe></small> -->
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769506606!2d2.277020441486908!3d48.858950680702144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sen!2sin!4v1621254467456!5m2!1sen!2sin" width="389" height="393" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                                <div class="shipped">
                                    <p class="green-time">{{$when}}</p>
                                    <div class="heading">
                                        <h4>{{$what}}<span>{{$where}}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="track">
                    @if(!empty($orderDetail))
                        @if(empty($orderDetail->tracking['error']))
                            <h5>Tracking Number{{empty($orderDetail->tracking) ? '' : ': ' . $orderDetail->tracking['tracking_history']['TrackID']}}</h5>
                            <div class="destiny mb-0" style='height: unset;'>
                                <ul id="tracking-summary-section" class="text-center mx-auto">
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                            @if(!empty($orderDetail->tracking['tracking_history']['Summary']['Event']))
                                                <h5>{{$orderDetail->tracking['tracking_history']['Summary']['Event']}}</h5>
                                                <p> {{empty($orderDetail->tracking['tracking_history']['Summary']['EventCity']) ? '' : $orderDetail->tracking['tracking_history']['Summary']['EventCity'].', '}}
                                                    {{empty($orderDetail->tracking['tracking_history']['Summary']['EventState']) ? '' : $orderDetail->tracking['tracking_history']['Summary']['EventState'].', '}}
                                                    {{empty($orderDetail->tracking['tracking_history']['Summary']['EventDate']) ? '' : $orderDetail->tracking['tracking_history']['Summary']['EventDate'].', '}}
                                                    {{$orderDetail->tracking['tracking_history']['Summary']['EventTime']}}
                                                </p>
                                            @else
                                                @if(empty($orderDetail->tracking) && empty($orderDetail->tracking['tracking_history']['TrackID']))
                                                    <h5>No tracking number information available.</h5>
                                                    <p>A status is not yet available.<br>It will be available when the shipper provides an update or the package is delivered to the courier.<br>Check back soon.</p>
                                                @elseif (!empty($orderDetail->tracking['tracking_history']['TrackID']) && !empty($orderDetail->tracking['tracking_history']['Notifications']['Message']))
                                                    <h5>{{$orderDetail->tracking['tracking_history']['Notifications']['Message']}}</h5>
                                                    <p></p>
                                                @else
                                                    <h5>Label Created, not yet in system.</h5>
                                                    <p>A status update is not yet available on your package.<br>It will be available when the shipper provides an update or the package is delivered to the courier.<br>Check back soon.</p>
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <h5>We found some errors retrieving your tracking data</h5>
                            <div class="destiny mb-0" style='height: unset;'>
                                <ul id="tracking-summary-section" class="text-center mx-auto">
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                                <h5>We can't retrieve your tracking information</h5>
                                                <p>Try again later, if problem persists please contact us</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        @endif
                        @if(!empty($orderDetail->tracking['tracking_history']['TrackDetail']))
                            <div class="row mb-4">
                                <div class="col-12">
                                    <a class="btn white mx-auto" href="javascript:void(0)" onclick="toggleDetails();" id="btn-toggle-details">Show details</a>
                                </div>
                            </div>
                        @endif
                        <div class="destiny hidden" id="destiny-hidden">
                            <div class="line">
                                @if(!empty($orderDetail->tracking['tracking_history']['TrackDetail']))
                                <ul id="progressbar" class="text-center ">
                                    @foreach($orderDetail->tracking['tracking_history']['TrackDetail'] as $track_detail)
                                    <li class="active step0">
                                        <div class="upper-content bar-content">
                                            <h5>{{$track_detail['Event']}}</h5>
                                            <?php
                                                $place =
                                                    rtrim(rtrim((empty($track_detail['EventCity']) ? '' : $track_detail['EventCity'] . ', ') . (empty($track_detail['EventState']) ? '' : $track_detail['EventState']), ' '), ',');
                                                $time =
                                                    rtrim(rtrim((empty($track_detail['EventDate']) ? '' : $track_detail['EventDate'] . ', ') . (empty($track_detail['EventTime']) ? '' : $track_detail['EventTime']), ' '), ',');

                                            ?>
                                            @if(!empty($place)) 
                                                <p>{{$place}}.</p> 
                                            @endif
                                            @if(!empty($time)) 
                                                <p>{{$time}}.</p> 
                                            @endif
                                            
                                        </div>
                                    </li>
                                    <hr class="track-details-line">
                                    <!-- <div class="progress-line"></div> -->
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
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

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('iframe');
        })
    </script>
</body>
</html>