<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Tests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/my-tests.css') }}" type="text/css" rel="stylesheet" media="screen" />

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

            <div class="main-content-section test-page test-page-two">
                <h2>My Tests <div class="test-btns">
                    <a class="btn white" href="javascript:void(0)" data-toggle="modal" data-target="#uploadsmodal"><img src="{{ asset('assets/images/tests/upload.png') }}" alt="upload">Upload Your Physical Tests</a>
                </h2>
                <div class="main-content-section-inner-test">
                    <div class="main-content-section-left">
                        <ul class="doctors-list">
                            @isset($userdata)
                                @foreach ($userdata as $data)
                                    <li class="activeDoctor">
                                        <a href="javascript:void(0)" class="doc_tests" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                                            {{-- <li class="activeDoctor"> --}}
                                            <div class="user">
                                                @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                {{-- <img src="{{ asset('assets/images/messages/6.png') }}" alt="{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}"> --}}
                                                <div class="text">
                                                    <p class="name">
                                                        @if(!empty($data->prescriber_firstname))
                                                            {{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}
                                                        @endif
                                                        <span class="category">{{ $data->diagnosis ?$data->diagnosis :''}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- </li> --}}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                    <div class="main-content-section-right" >
                        {{-- Tests Page --}}
                        <div class="main-content-section-right-inner" id="test_detail" >
                            <!-- Modal -->
                            <div class="modal fade common-modal view-modal" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> -->
                                            <div class="modal-success-content">
                                                <div class="modal-upper-content-left">
                                                    <p class="modal-link"><img src="{{ asset('assets/images/tests/pin.png') }}" /> </p>
                                                </div>
                                                <div class="modal-upper-content-right">
                                                    <h2>Physical test</h2>
                                                    <p>29 April, 2021</p>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade common-modal success-modal" id="successmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> -->
                                            <div class="modal-heading-custom">
                                                <h2>Successfully Uploaded</h2>
                                            </div>
                                            <div class="modal-success-content">
                                                <div class="modal-upper-content-left">
                                                    <p class="modal-link"><img src="{{ asset('assets/images/tests/pin.png') }}" /> </p>
                                                </div>
                                                <div class="modal-upper-content-right">
                                                    <h2>Physical test</h2>
                                                    <p>29 April, 2021</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade common-modal upload-modal" id="uploadsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <a href="#" class="drop-file">
                                                {{-- Uploading file on change and storing case num in hidden field --}}
                                                {{-- <form id="test_report_upload" action="{{ env('API_URL') }}?fn=upload_lab_report" method="post" enctype="multipart/form-data"> --}}
                                                <form id="test_report_upload" action="{{env('APP_URL')}}/upload_test_report" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="test" id="test" onchange="fileSelected(this);" />
                                                    <input type="hidden" value="" id="case_num" name="casenum" />
                                                    <input type="hidden" value="" id="upload_email" name="email" />
                                                    <img src="{{ asset('assets/images/tests/cloud.png') }}" />
                                                    <p>Drop files here (OR) Click to Upload</p>
                                                </form>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="main-content-section-inner">
                                
                                <div class="test-search-text">
                                    <h2><span class="main"><img src="{{ asset('assets/images/orders/icon1.png') }}" alt="arrow">Uploaded Physical Tests</span></h2>
                                    <div id="test_search_bar" class="search-bar">
                                        <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
                                        <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
                                    </div>
                                </div> 
                                <div class="scroller-list">
                                    {{-- <div class="test-heading">
                                        <span class="text">Today visit</span>
                                        <span class="line"></span>
                                    </div> --}}
                                    {{-- listing view here --}}
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
            // emptying the div of reports listing 
            $('.scroller-list').empty();
            // finding and clicking on the first doc in doc listing
            $('.doctors-list > li').first().find('a').trigger('click');
        });

        $(document).on('click', '.activeDoctor', function() {

            $('.activeDoctor').removeClass('active');
            $(this).addClass('active');
        });

        // Get test listing
        $(document).on('click', '.doc_tests', function() {
            // loader
            $('.loader').show();        

            var doc_info = $(this).attr('doc_info');
            doc_info = JSON.parse(doc_info);
            // using CURL to get messages
            $('#case_num').val($(this).attr('casenum'));
            $('#upload_email').val(doc_info['email']);

            var url = "{{ env('APP_URL') . '/get_tests' }}"
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    casenum: $(this).attr('casenum'),
                    case_id: doc_info['id']
                },
                success: function(response) {
                    // console.log(response);

                    $('.scroller-list').empty();
                    $('.scroller-list').append(response);
                    $('.loader').hide();
                    // modal
                    // data-toggle="modal" data-target="#uploadsmodal"
                }
            });
        });
        // file upload function
        function fileSelected(input) {
            if (input.files[0].name) {
                // $('.loader').show();
                $('#test_report_upload').ajaxForm({
                    success: function(response) {
                        // $('.loader').hide();
                        $('#uploadsmodal').hide();
                        console.log(response);
                        console.log(input.files[0].name);
                    },
                    error: function() {
                        // $('.loader').hide();
                        // Show error message
                    },
                }).submit();
            }
        }
    </script>
</body>
</html>