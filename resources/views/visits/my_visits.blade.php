<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Visits</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/my-visits.css') }}" type="text/css" rel="stylesheet" media="screen" />

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
                <!-- <div class="loader-loading">
                    <span class="loading-text">Loading</span>
                    <div class="dot-pulse"></div>
                </div> -->
            </div>
        </div>
        <div class="section-inner">

            @include('layout.sidebar')
            <div class="main-content-section visits-main-page">
                <h2>My Visits
                    {{-- <div class="white-box"> --}}
                    {{-- <div class="date"><img src="{{asset('assets/images/visits/left-arrow.png')}}" alt="left-arrow">
                            <span>22 April 2021</span><img src="{{asset('assets/images/visits/right-arrow.png')}}" alt="right-arrow"></div><a class="calender"href="javascript:void(0)">
                            <img src="{{asset('assets/images/visits/calender.png')}}" alt="calender"></a>
                    </div> --}}
                </h2>
                <div class="main-content-section-inner">
                    <div class="main-content-section-left">
                        <ul class="nav nav-tabs" id="leftTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if(!empty($yearArray) && empty($monthArray) && empty($weekArray)) active @endif" id="year-tab" data-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Year</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if(!empty($monthArray) && empty($weekArray)) active @endif" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Month</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link   @if(!empty($weekArray) && empty($yearArray) && empty($monthArray)) active @endif" id="week-tab" data-toggle="tab" href="#week" role="tab" aria-controls="week" aria-selected="false">Week</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="leftTabContent">
                            {{-- different docs --}}
                            <div class="tab-pane fade  @if (!empty($yearArray) && empty($monthArray) && empty($weekArray)) show active @endif" id="year" role="tabpanel" aria-labelledby="year-tab">
                                {{-- Year Tab --}}
                                <ul class="doctors-listing">
                                    @php $count=0; @endphp
                                    @foreach ($yearArray as $data)
                                        @php $count++ @endphp
                                        <li class="doctors-list consult_{{ $data->case_number }}" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                                            <div class="profile-icon">
                                                @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                <div>
                                                    @if( !empty($data->prescriber_firstname))
                                                        <span class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                                                    @endif
                                                    <span class="sub diagnos">{{ $data->diagnosis ? $data->diagnosis :'' }}</span>
                                                </div>
                                            </div>
                                            <div class="time-list">
                                                <span><img src="{{ asset('assets/images/visits/bell.png') }}" alt="time">{{ $data->created_at ? date('M d, Y.', strtotime($data->created_at )) : '' }} </span>
                                                {{-- <a href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}" alt="dot"></a> --}}
                                            </div>
                                            <span class="bottom-line"></span>
                                        </li>
                                    @endforeach
                                    @if ($count == 0)
                                        <center> No Records Found </center>
                                    @endif
                                </ul>
                            </div>

                            <div class="tab-pane fade  @if (!empty($monthArray) && empty($weekArray)) show active @endif" id="month" role="tabpanel" aria-labelledby="month-tab">
                                {{-- Month Tab --}}
                                <ul class="doctors-listing">
                                    @php $count=0; @endphp
                                    @foreach ($monthArray as $data)
                                        @php $count++ @endphp
                                        <li class="doctors-list consult_{{ $data->case_number }}" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                                            <div class="profile-icon">
                                                @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                <div>
                                                @if( !empty($data->prescriber_firstname))
                                                    <span class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                                                @endif
                                                    <span class="sub diagnos">{{ $data->diagnosis ?$data->diagnosis :'' }}</span>
                                                </div>
                                            </div>
                                            <div class="time-list">
                                                <span><img src="{{ asset('assets/images/visits/bell.png') }}" alt="time"> {{ $data->created_at ? date('l, M d', strtotime($data->created_at)) : '' }} </span>
                                                <a href="javascript:void(0)"><img src="{{ asset('assets/images/visits/dots.png') }}" alt="dot"></a>
                                            </div>
                                            <span class="bottom-line"></span>
                                        </li>
                                    @endforeach
                                    @if ($count == 0)
                                        <center> No Records Found </center>
                                    @endif
                                </ul>
                            </div>

                            <div class="tab-pane fade  @if (!empty($weekArray) && empty($yearArray) && empty($monthArray)) show active @endif" id="week" role="tabpanel" aria-labelledby="week-tab">
                                {{-- Week Tab --}}
                                <ul class="doctors-listing">
                                    @php $count=0; @endphp
                                    @foreach ($weekArray as $data)
                                        @php $count++ @endphp
                                        <li class="doctors-list consult_{{ $data->case_number }}" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                                            <div class="profile-icon">
                                                 @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                <div>
                                                @if( !empty($data->prescriber_firstname))
                                                    <span
                                                        class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                                                @endif
                                                    <span class="sub diagnos">{{ $data->diagnosis ?$data->diagnosis:'' }}</span>
                                                </div>
                                            </div>
                                            <div class="time-list">
                                                <span><img src="{{ asset('assets/images/visits/bell.png') }}"
                                                        alt="time">
                                                    {{ $data->created_at?date('l, M d', strtotime($data->created_at)):''}}</span>
                                                <a href="javascript:void(0)"><img
                                                        src="{{ asset('assets/images/visits/dots.png') }}"
                                                        alt="dot"></a>
                                            </div>
                                            <span class="bottom-line"></span>
                                        </li>
                                    @endforeach
                                    @if ($count == 0)
                                        <center> No Records Found </center>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="main-content-section-right">
                        {{-- Visits Page --}}
                        <div class="main-content-section-right-inner" id="prescriber_detail" style="display: none">
                            <div class="header">
                                <div class="profile-icon">
                                        <img id="defaultImage" src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                        <img src="" id="doc_image" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                        <div>
                                        <span class="main" id="doc_name"></span>
                                        <span class="sub diagnos subdiagnosname">Family medicine</span>
                                    </div>
                                </div>
                                <div class="case-status">
                                    <span class="main">Case Status:</span>
                                    <span class="sub" id="case_status"></span>
                                </div>
                            </div>

                            <ul class="nav nav-tabs" id="rightTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="diagnosis-details" data-toggle="tab"
                                        href="#diagnosis" role="tab" aria-controls="diagnosis"
                                        aria-selected="true">Diagnosis Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="view-prescription" data-toggle="tab" href="#prescription"
                                        role="tab" aria-controls="prescription" aria-selected="false">Dose</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="provider-details" data-toggle="tab" href="#provider"
                                        role="tab" aria-controls="provider" aria-selected="false">Provider Details</a>
                                </li>
                            </ul>
                            <span id="refillResponse"></span>
                            <div class="tab-content" id="rightTabContent">
                                <div class="tab-pane fade show active" id="diagnosis" role="tabpanel"
                                    aria-labelledby="diagnosis-details">
                                    <div class="sub-heading">
                                        Condition details
                                    </div>
                                    <ul class="symptoms-listing" id="condition_qas">
                                        <!-- <li class="symptoms-list">
                                            <span class="main">Do you feel frustrated with yourself because of your
                                                body?</span>
                                            <span class="sub">Yes</span>
                                        </li>
                                        <li class="symptoms-list">
                                            <span class="main">Have you ever been treated for obesity?</span>
                                            <span class="sub">Yes</span>
                                        </li>
                                        <li class="symptoms-list">
                                            <span class="main">Do you follow any lifestyle modifications like diet. exercise routines etc.?</span>
                                            <span class="sub">Yes, I work out 3 times a week.</span>
                                        </li> -->
                                    </ul>
                                    
                                    <!--
                                    <div class="sub-heading" id="faceshot_photoid_images_heading" style="display:none;">
                                        Upload Faceshot and PhotoId
                                    </div>
                                    <ul class="symptoms-listing" id="faceshot_photoid_images_section" style="display:none;">
                                        <li class="symptoms-list image-uploader" id="faceshotImage">
                                            <img src="" id="faceshot_image" style="height:100px;width:100px;" />
                                            {{--
                                            <form id="image_upload" action="{{ env('APP_URL') }}/upload_visits_image" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' name="visits_image" accept="image/*" onchange="fileSelected(this);" />
                                                <input type="hidden" value="" id="case_num" name="case_num" />
                                            </form>
                                            --}}
                                        </li>

                                        {{--
                                        <li class="symptoms-list image-uploader" id="face_shot_uploader">
                                            <a href="#" class="drop-file">
                                                <form id="image_upload" action="{{ env('APP_URL') }}/upload_visits_image" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type='file' name="visits_image" accept="image/*" onchange="fileSelected(this);" />
                                                    <img id="blah" src="{{ asset('assets/images/tests/cloud.png') }}" alt="your image" />
                                                    <span class="sub">Click here to<br>Upload Faceshot</span>
                                                    <input type="hidden" value="" id="case_num" name="case_num" />
                                                </form>
                                                <div class="text-danger" style="font-size: 14px;width: 165px;">
                                                {{ $errors->first('visits_image') }}</div>
                                            </a>
                                        </li>
                                        --}}

                                        <li class="symptoms-list image-uploader" id="photoIdImage">
                                            <img src="" id="photoId_image_src" style="height:100px;width:100px;" />
                                            {{--
                                            <form id="photoId_upload" action="{{ env('APP_URL') }}/upload_photo_id_image" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' name="photoId_image" accept="image/*" onchange="fileSelected1(this);" />
                                                <input type="hidden" value="" id="case_num1" name="case_num1" />
                                            </form>
                                            --}}
                                        </li>

                                        {{--
                                        <li class="symptoms-list image-uploader" id="photo_id_uploader">
                                            <a href="#" class="drop-file">
                                                <form id="photoId_upload" action="{{ env('APP_URL') }}/upload_photo_id_image" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type='file' name="photoId_image" accept="image/*" onchange="fileSelected1(this);" />
                                                    <img id="blah" src="{{ asset('assets/images/tests/cloud.png') }}" alt="your image" />
                                                    <span class="sub">Click here to<br>Upload PhotoId</span>
                                                    <input type="hidden" value="" id="case_num1" name="case_num1" />
                                                </form>
                                                <div class="text-danger" style="font-size: 14px;width: 165px;">
                                                {{ $errors->first('photoId_image') }}</div>
                                            </a>
                                        </li>
                                        --}}
                                    </ul>
                                    -->

                                    <div class="sub-heading" id="uploadable_images_heading">
                                        Area of concern
                                    </div>
                                    <ul class="symptoms-listing" id="uploadable_images_section">
                                         <li class="symptoms-list image-uploader" id="currentAreaUploadedImage">
                                            <img src="" id="currentAreaUpload_image" style="height:100px;width:100px;" />
                                            <form id="areaOfConcern_upload" action="{{ env('APP_URL') }}/upload_areaOfConcern_image" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' name="areaOfConcern_image" accept="image/*" onchange="fileSelected2(this);" />
                                                <input type="hidden" value="" id="case_num2" name="case_num2" />
                                            </form>
                                        </li>
                                        <li class="symptoms-list image-uploader" id="currentArea_image_upload">
                                            <a href="#" class="drop-file">
                                                <form id="image_upload" action="{{ env('APP_URL') }}/upload_areaOfConcern_image" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type='file' name="areaOfConcern_image" accept="image/*" onchange="fileSelected2(this);" />
                                                    <img id="blah" src="{{ asset('assets/images/tests/cloud.png') }}" alt="your image" />
                                                    <span class="sub">Click here to<br>Upload Image</span>
                                                    <input type="hidden" value="" id="case_num2" name="case_num2" />
                                                </form>
                                                <div class="text-danger" style="font-size: 14px;width: 165px;">
                                                {{ $errors->first('areaOfConcern_image') }}</div>
                                            </a>
                                        </li>
                                        
                                        {{--
                                        <li id="imageContainer" class="symptoms-list image-uploader"> </li>
                                        <li id="currentAreaUploadedImage" class="symptoms-list image-uploader" style="display:none;"> </li>
                                        <li class="symptoms-list image-uploader">
                                            <form id="areaOfConcern_upload" action="{{ env('APP_URL') }}/upload_areaOfConcern_image" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' name="areaOfConcern_image" accept="image/*" onchange="fileSelected2(this);" />
                                                <img id="blah" src="{{ asset('assets/images/tests/cloud.png') }}" alt="your image" />
                                                <span class="sub">Click here to Upload Image</span>
                                                <input type="hidden" value="" id="case_num2" name="case_num2" />
                                            </form>
                                        </li>
                                        --}}
                                    </ul>
                                    <div class="sub-heading">
                                        Diagnosis
                                    </div>
                                    <p class="diagnosis-data" id="diagnos"> </p>
                                    <div class="sub-heading">
                                        Recent Vitals
                                    </div>
                                    <ul class="vitals-listing">
                                        <li class="vitals-list">
                                            <span class="main">Height</span>
                                            <span class="sub" id="height"> </span>
                                        </li>
                                        <li class="vitals-list">
                                            <span class="main">Weight</span>
                                            <span class="sub" id="weight"> </span>
                                        </li>
                                        <li class="vitals-list">
                                            <span class="main">Mass Index</span>
                                            <span class="sub" id="bmi"><small>BMI</small></span>
                                        </li>
                                    </ul>
                                    <div class="sub-heading alergy">
                                        Allergies
                                    </div>
                                    <ul class="alergies-listing">
                                        <li class="alergies-list">
                                            <span class="main" id="allergies"> </span>
                                            <span class="sub"></span>
                                        </li>
                                        {{-- <li class="alergies-list hide">
                                                <span class="main">Allergy 2</span>
                                                <span class="sub">Lorem ipsum dolor sit amet, consectetur adipiscing eli</span>
                                        </li> --}}
                                    </ul>
                                    <div class="sub-heading alergy">
                                        Medications
                                    </div>
                                    <ul class="alergies-listing">
                                        <li class="alergies-list">
                                            <span class="main" id="medication"></span>
                                            <span class="sub"></span>
                                        </li>
                                        {{-- Medication 2 --}}
                                        {{-- <li class="alergies-list">
                                                <span class="main">Beta blockers</span>
                                                <span class="sub">Feeling tired, dizzy or lightheaded </span>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="prescription" role="tabpanel" aria-labelledby="view-prescription">
                                    <ul class="prescription-detail">
                                        <li class="prescription-detail-list">
                                            <span class="circle circle-left"></span>
                                            <span class="circle circle-right"></span>
                                            <img src="{{ asset('assets/images/visits/cm.png') }}" alt="liq">
                                            <div class="prescription-detail-list-inner">
                                                <h4 id="requested_treatment_name" class="doseClass">   </h4>
                                                <form  name="refillForm" id="refillForm">
                                                                    @csrf
                                                                    <input type="hidden" name="caseNumber" id="caseNumber" value="" />
                                                                    <div class="mb15">
                                                                        <button type="button" class="new-card-btn refillButtonClass" id="refillButton" onclick="">Refill</button>
                                                                    </div> 
                                                                </form>
                                                <!-- <button class="new-card-btn refillButtonClass" id="refillButton">Refill</button> -->
                                              
                                                <!-- <div class="modal fade mint-popup add-new-popup-modal" id="RefillPopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="add-card-header">
                                                                    <h2 class="card-heading">Refill</h2>
                                                                </div>
                                                                <span id="msg"></span>
                                                                <form  name="refillForm" id="refillForm">
                                                                    @csrf
                                                                    <div class="form-group mb15">
                                                                        <label for="exampleInputEmail">Medical change</label>
                                                                        <textarea id="medicalChange"  class="form-control" name="medicalChange"  aria-describedby="emailHelp" value="" ></textarea>
                                                                        <div class="text-danger">{{ $errors->first('medicalChange') }}</div>
                                                                    </div>
                                                                    <input type="hidden" name="caseNumber" id="caseNumber" value="" />
                                                                    <div class="mb15">
                                                                        <button type="button" id="refillButton" class="save-btn btn">Save</button>
                                                                    </div> 
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="two-sections">
                                                    <div class="left">
                                                       <div class="main">Drug Name</div>
                                                        <div class="sub" id="drug_name"></div>
                                                        <!-- <div class="sub">3 times | 9am, 3pm, 9pm</div>
                                                        <a class="btn white" href="javascript:void(0)">Order Medicine</a> -->
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Dosage</div>
                                                        <div class="sub" id="dosage"></div>
                                                        <!-- <a class="btn white" href="javascript:void(0)">Set Reminder</a> -->
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Pill Count</div>
                                                        <div class="sub" id="pill_count"></div>
                                                        <!--<a class="btn white" href="javascript:void(0)">Order Medicine</a> -->
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Dispense</div>
                                                        <div class="sub" id="dispense"></div>
                                                        <!--<a class="btn white" href="javascript:void(0)">Order Medicine</a> -->
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Refills</div>
                                                        <div class="sub" id="refills"></div>
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Days Supply</div>
                                                        <div class="sub" id="days_supply"></div>
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">NDC</div>
                                                        <div class="sub" id="ndc"></div>
                                                    </div>
                                                    <div class="left">
                                                        <div class="main">Subscription Plan</div>
                                                        <div class="sub" id="subscription_plan"></div>
                                                        <!-- <div class="sub">3 times | 9am, 3pm, 9pm</div>
                                                        <a class="btn white" href="javascript:void(0)">Order Medicine</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="provider" role="tabpanel" aria-labelledby="provider-details">
                                    <div class="provider-header">
                                        <img  id="doctor_image_default" src="{{asset('assets/images/messages/2.png')}}" alt="doc" style="width: 40px;height:40px;object-fit:cover;display:none">
                                        <img  id="doctor_image" alt="doc" style="width: 40px;height:40px;object-fit:cover;">
                                        <div class="form-group">
                                            <label for="exampleInputName">Name:</label>
                                            <input type="text" class="form-control" id="doctor_name" aria-describedby="emailHelp" value="Dr. " disabled>
                                        </div>
                                    </div>
                                    <h2>Contact Information</h2>
                                    <div class="form-group mb15">
                                        <label for="exampleInputEmail">Email:</label>
                                        <input type="text" class="form-control" id="prescriber_email" aria-describedby="emailHelp" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPhone">Phone:</label>
                                        <input type="text" class="form-control" id="prescriber_phonenumber" aria-describedby="emailHelp" value="" disabled>
                                    </div>
                                    <h2>Specialty</h2>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="specialty" aria-describedby="emailHelp" value="Family medicine, general medicine and endocrinologist" disabled>
                                    </div>
                                    <h2>Bio</h2>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="prescriber_bio" aria-describedby="emailHelp" value="" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Visits Page Hidden --}}
                        <div class="main-content-section-right-inner" id="visits_home">
                            <div class="main-content-section-bottom">
                                <h4>All Prescriptions</h4>
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <th>Diagnosis</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Detail</th>
                                        <th>Duration</th>
                                    </thead>
                                    <tbody>
                                        @isset($userdata)
                                            @php
                                                if (!is_array($userdata)) {
                                                    $userdata = [];
                                                }
                                            @endphp
                                            @foreach ($userdata as $data)
                                            @if (isset($data))
                                                @php
                                                    if (!is_array($userdata)) {
                                                        $data = [];
                                                    }
                                                @endphp
                                                {{-- {{dd($data)}} --}}
                                                {{-- <a href="javascript:void(0)" class="doctors-list"> --}}
                                                <tr>
                                                    <td>
                                                        <div class="disease_new"><span>
                                                            <img src="{{ asset('assets/images/visits/shape.png') }}" alt="shape">
                                                            @if(!empty($data->case_number))
                                                                </span><a href="javascript:void(0)" onclick="$('.consult_{{ $data->case_number }}').trigger('click')">{{ $data->diagnosis?$data->diagnosis:'' }}</a></div>
                                                            @endif
                                                    </td>
                                                    @if(!empty($data->prescriber_firstname))
                                                        <td>Dr. {{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }} </td>
                                                    @endif
                                                    <td>{{ $data->created_at ? date('l, M d', strtotime($data->created_at)) : '' }}</td>
                                                    <td>{{ $data->actual_prescription_name?$data->actual_prescription_name:'' }}</td>
                                                    <td>{{ $data->days_supply?$data->days_supply:'' }}</td>
                                                {{-- </a> --}}
                                                </tr>                                                
                                            @endif
                                            @endforeach
                                        @endisset                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mint-popup" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                    Image uploaded successfully
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button> 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mint-popup" id="uploadImageErrorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                         Something went wrong
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button> 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mint-popup" id="refillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        Refill order successfully
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button> 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade mint-popup" id="invalidImageTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                       Image uploaded extension is invalid
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button> 
                    </div>
                </div>
            </div>
        </div>
    </section>
<input type="hidden" id="user_data" value='@php echo json_encode($userdata); @endphp'/>
    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')
    <script>
        // app url for global search
        var app_url = "{{ env('APP_URL') }}"

        $(document).ready(function() {
            AOS.init();
        });

        // Trying localstorage
        var json_userdata = $('#user_data').val();
        // console.log(json_userdata);
        var json_userdata = json_userdata.replace('\r\n', '');
        localStorage.setItem('json_userdata', LZString.compress(json_userdata));

        // global search included here path is -> public/asssets/js/global_search.js

        $(document).on('click', '.doctors-list', function() {
            $("#prescriber_detail").show();
            $("#visits_home").hide();

            // animating the page
            $('html, body').animate({
                scrollTop: $("#prescriber_detail").offset().top
            }, 300);

            $('.doctors-list').removeClass('active');
            $(this).addClass('active');
            var doc_info = $(this).attr('doc_info');
            doc_info = JSON.parse(doc_info);
            // console.log(doc_info);
            // if((doc_info['condition_qas']=='')||(doc_info['condition_qas']==null)||(doc_info['condition_qas'])){
            if(doc_info['medical_information_qas']){
                var condQas= JSON.parse(doc_info['medical_information_qas']);
            }
            if((condQas!='')&&(condQas!=null)){
                // var i = 0;
                for(ind in condQas.q) {
                    var list=$('#condition_qas');
                    list.append('<li class="symptoms-list"><span class="sub sub-parent">Question '+ind+'</span><span class="main">'+condQas.q[ind]+'</span> <span class="sub">'+condQas.a[ind] +'</span></li>');
                }
            } else {
                $('#condition_qas').html('');
            }
            
            if(doc_info['doc_image']!='' && doc_info['doc_image']!=null){
                var img=document.getElementById('doc_image');
            img.src="data:image/png;base64,"+doc_info['doc_image'];
            }else{
                $('#doc_image').hide();
                $('#defaultImage').show();
            }
           
            $('#case_num').val(doc_info['case_number']?doc_info['case_number']:'');
            $('#caseNumber').val(doc_info['case_number']?doc_info['case_number']:'');
            if(doc_info['case_status']!='' && doc_info['case_status']!=null){
                if(doc_info['case_status']=='RX Refill'){
                    $('#refillButton').button("disable");
                    $('#refillButton').addClass('newRefillButton'); 
                    $('#refillButton').removeAttr("onclick");
                } else {
                    $('#refillButton').removeClass('newRefillButton'); 
                    $('#refillButton').attr("onclick",'refillButton1()');
                }
            }
            
            $('#case_num1').val(doc_info['case_number']?doc_info['case_number']:'');
            $('#case_num2').val(doc_info['case_number']?doc_info['case_number']:'');

            /*
            if ((doc_info['image_2'] != '') && (doc_info['image_2'] != null) || (doc_info['image_1'] != '') && (doc_info['image_1'] != null)) {
                $('#faceshot_photoid_images_heading').show();
                $('#faceshot_photoid_images_section').show();
            } else {
                $('#faceshot_photoid_images_heading').hide();
                $('#faceshot_photoid_images_section').hide();
            }
            
            if ((doc_info['image_1'] != '') && (doc_info['image_1'] != null)) {
                document.getElementById('faceshot_image').src = doc_info['image_1'];
                $('#face_shot_uploader').hide();
            } else {
                $('#faceshotImage').hide();
            }

            if ((doc_info['image_2'] != '') && (doc_info['image_2'] != null)) {
                document.getElementById('photoId_image_src').src = doc_info['image_2'];
                $('#photo_id_uploader').hide();
            } else {
                $('#photoIdImage').hide();
            }
            */

            if ((doc_info['image_3'] != '') && (doc_info['image_3'] != null)) {
                document.getElementById('currentAreaUpload_image').src = doc_info['image_3'];
                $('#currentArea_image_upload').hide();
                $('#currentAreaUploadedImage').show();
            } else {
                if (doc_info['medical_intake_condition'] != 'SKIN'){
                    $('#uploadable_images_heading').hide();
                    $('#uploadable_images_section').hide();
                }
                $('#currentAreaUploadedImage').hide();
                $('#currentArea_image_upload').show();
            }

            // console.log(doc_info['case_number']);
            var heightString = ((doc_info['height'] != '') && (doc_info['height'] != '')) ? doc_info['height'] : 0;
            var weightString = ((doc_info['weight'] != '') && (doc_info['weight'] != null)) ? doc_info['weight'] : 0;

            var heightNumber = heightString != 0 ? heightString.match(/\d+/g).map(Number) : 0;
            var weightNumber = weightString != 0 ? weightString.match(/\d+/g).map(Number) : 0;
            var heightInches = 0;
            if (heightNumber != 0) {
                if (heightNumber[1] != '') {
                    heightInches = heightNumber[0] * 12 + heightNumber[1];
                    heightInches /= 39.3700787;
                } else {
                    heightInches = heightNumber[0] * 12;
                    heightInches /= 39.3700787;
                }
            }
            weightNumber != 0 ? weightNumber /= 2.20462 : weightNumber;
            if (weightNumber == 0 || heightInches == 0) {
                var calculatedBmi = 0;
            } else {
                calculatedBmi = weightNumber / Math.pow(heightInches, 2);
            }

            //Perform calculation
            // console.log(calculatedBmi);
            if(doc_info['prescriber_firstname']!='' && doc_info['prescriber_firstname']!=null){
                $('#doc_name').html(doc_info['prescriber_firstname'] + ' ' + doc_info['prescriber_lastname']);
            }else{
                $('#doc_name').html();  
            }
           
            $('#case_status').html(doc_info['case_status']?doc_info['case_status']:'');
            $('#diagnos').html(doc_info['diagnosis']?doc_info['diagnosis']:'');
            $('.subdiagnosname').html(doc_info['diagnosis']?doc_info['diagnosis']:'');

            $('#medication').html(doc_info['medications']);
            $('#height').html(doc_info['height'] ? doc_info['height'] : 0);
            $('#weight').html(doc_info['weight'] ? doc_info['weight'] : 0);
            $('#bmi').html(calculatedBmi.toFixed(2));

            $('#allergies').html(doc_info['allergies']);
            $('#requested_treatment_name').html(doc_info['requested_treatment_name']?doc_info['requested_treatment_name']:'');
            if(doc_info['doc_image']!='' && doc_info['doc_image']!=null){
                var img=document.getElementById('doctor_image');
            img.src="data:image/png;base64,"+doc_info['doc_image'];
            }else{
                $('#doctor_image_default').show();
                $('#doctor_image').hide();
            }
            if(doc_info['prescriber_firstname']!='' && doc_info['prescriber_firstname']!=null){
                $('#doctor_name').val(doc_info['prescriber_firstname'] + ' ' + doc_info['prescriber_lastname']);
            }else{
                $('#doctor_name').val('');
            }
         
            $('#prescriber_phonenumber').val(doc_info['prescriber_phonenumber']?doc_info['prescriber_phonenumber']:'');
            $('#prescriber_email').val(doc_info['prescriber_email']?doc_info['prescriber_email']:'');
            $('#prescriber_bio').val(doc_info['prescriber_bio'] ? doc_info['prescriber_bio'] : '');
            $('#specialty').val(doc_info['diagnosis']?doc_info['diagnosis']:'');
            $('#dosage').html(doc_info['dosage'] ? doc_info['dosage'] : '');
            $('#refills').html(doc_info['refills'] ? doc_info['refills'] : '');
            $('#days_supply').html(doc_info['days_supply'] ? doc_info['days_supply'] : '');
            $('#ndc').html(doc_info['NDC'] ? doc_info['NDC'] : '');
            $('#pill_count').html(doc_info['quantity'] ? doc_info['quantity'] : '');
            $('#dispense').html(doc_info['dispense_units'] ? doc_info['dispense_units'] : '');
            $('#drug_name').html(doc_info['actual_prescription_name'] ? doc_info['actual_prescription_name'] : '');

            $('#subscription_plan').html(doc_info['subscription_plan'] ? doc_info['subscription_plan'] : '');

            $('.main-content-section').removeClass('visits-main-page');
        });

        function fileSelected(input) {
            if (input.files[0].name) {
                $('.loader').show();
                $('#image_upload').ajaxForm({
                    success: function(response) {
                        var res=JSON.parse(response);
                        if(res.status==0){
                                 $('.loader').hide();
                            $('#uploadImageErrorModal').modal({
                                show:true
                            });
                        }else if (res.status==1) {
                            $('.loader').hide();
                            $('#uploadImageModal').modal({
                                show:true
                            });
                            document.getElementById('faceshot_image').src = res.imagePath;
                        } else if(res.status==3){
                            $('.loader').hide();
                            $('#invalidImageTypeModal').modal({
                                show:true
                            });
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        var validator = $("#image_upload").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },

                }).submit();
            }
        }

        function fileSelected1(input) {
            if (input.files[0].name) {
                $('.loader').show();
                $('#photoId_upload').ajaxForm({
                    success: function(response) {
                        var res=JSON.parse(response);
                        if(res.status==0){
                                 $('.loader').hide();
                            $('#uploadImageErrorModal').modal({
                                show:true
                            });
                        }else if (res.status==1) {
                            $('.loader').hide();
                            $('#uploadImageModal').modal({
                                show:true
                            });
                            document.getElementById('photoId_image_src').src = res.imagePath;
                        } else if(res.status==3){
                            $('.loader').hide();
                            $('#invalidImageTypeModal').modal({
                                show:true
                            });
                        }
                        
                        // else {
                        //     $('.loader').hide();
                        //     $('#uploadImageErrorModal').modal({
                        //         show:true
                        //     });
                        // }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        var validator = $("#photoId_upload").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                }).submit();
            }
        }
        

        function fileSelected2(input) {
            if (input.files[0].name) {
                $('.loader').show();
                $('#areaOfConcern_upload').ajaxForm({
                    success: function(response) {
                        var res=JSON.parse(response);
                        if(res.status==0){
                                 $('.loader').hide();
                            $('#uploadImageErrorModal').modal({
                                show:true
                            });
                        }else if (res.status==1) {
                            $('.loader').hide();
                            $('#uploadImageModal').modal({
                                show:true
                            });
                            document.getElementById('currentAreaUpload_image').src = res.imagePath;
                        } else if(res.status==3){
                            $('.loader').hide();
                            $('#invalidImageTypeModal').modal({
                                show:true
                            });
                        }
                    },
                    error: function(error) {
                        $('.loader').hide();
                        var validator = $("#areaOfConcern_upload").validate();
                        var objErrors = {};
                        for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                            objErrors[key] = value[0];
                        }
                        validator.showErrors(objErrors);
                    },
                }).submit();
            }
        }

        /*
        $("#refillForm").validate({
                rules: {
                    medicalChange: {
                        required: true,
                    },
                },
                messages: {

                    medicalChange: {
                        required: "Please fill medical change",
                    }
                }
        });
        */

        function refillButton1(){
            $('.loader').show();
           
           $("#refillForm").valid();
               if (!$("#refillForm").valid()) {
                        $('.loader').hide();
                       return false;
                   }
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                        url: "{{ URL::to('/refill') }}",
                        type: "POST",
                        data: $('#refillForm').serialize(),
                        success: function(response) {
                            $('.loader').hide();
                            // $('#RefillPopupModal').hide();
                            // console.log("response"+response);
                            if (response == 0) {
                                $('#uploadImageErrorModal').modal({
                                show:true
                                });
                                // console.log("error");
                                // $('#refillResponse').html('Something went wrong');
                                // $('#msg').html('Your card is saved successfully');
                                // $('#paymentForm :input').attr('value', '');
                            } else{
                                var refillResponse = JSON.parse(response);
                                if(refillResponse.code=="success")
                                {
                                     $('#refillResponse').html('Refill updated successfully');
                                    $('#refillModal').modal({
                                    show:true
                                });
                                $('#case_status').html('RX Refill');
                                $('#refillButton').button("disable");
                                $('#refillButton').addClass('newRefillButton'); 
                                $('#refillButton').removeAttr("onclick");

                                }
                               

                               // console.log(refillResponse.code);
                            }
                        },
                        error: function(error) {
                            $('.loader').show();
                            // $('#RefillPopupModal').hide();

                            var validator = $("#refillForm").validate();
                            var objErrors = {};
                            for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                                objErrors[key] = value[0];
                            }
                            validator.showErrors(objErrors);
                        },
                    });
           
        }
        
        /*
        $('#refillButton').click(function() {
            $('.loader').show();
           
           $("#refillForm").valid();
               if (!$("#refillForm").valid()) {
                        $('.loader').hide();
                       return false;
                   }
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                        url: "{{ URL::to('/refill') }}",
                        type: "POST",
                        data: $('#refillForm').serialize(),
                        success: function(response) {
                            $('.loader').hide();
                            // $('#RefillPopupModal').hide();
                            console.log("response"+response);
                            if (response == 0) {
                                console.log("error");
                                $('#refillResponse').html('Something went wrong');
                                // $('#msg').html('Your card is saved successfully');
                                // $('#paymentForm :input').attr('value', '');
                            } else{
                                var refillResponse = JSON.parse(response);
                                if(refillResponse.code=="success")
                                $('#refillResponse').html('Refill updated successfully');

                               console.log(refillResponse.code);
                            }
                        },
                        error: function(error) {
                            $('.loader').show();
                            // $('#RefillPopupModal').hide();

                            var validator = $("#refillForm").validate();
                            var objErrors = {};
                            for (const [key, value] of Object.entries(error.responseJSON.errors)) {
                                objErrors[key] = value[0];
                            }
                            validator.showErrors(objErrors);
                        },
                    });
                });
        */           

        
    </script>
</body>
</html>