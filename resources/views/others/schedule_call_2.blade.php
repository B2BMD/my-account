<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/schedule-call.css') }}" type="text/css" rel="stylesheet" media="screen" />

    <style type="text/css">
        :root {
            --Primarycolor: #2680BC;
            --Secondarycolor: #E5F6E8;
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

            <div class="main-content-section schedule-call reschedule-call">
                <h2>My Appointment</h2>
                <div class="main-content-section-inner">
                    <div class="reschedule-call-inner">
                        <h4>Your Upcoming Appointments</h4>
                        <!-- <a class="btn reschedule-btn" href="javascript:void(0)" id="schCall">Schedule another call</a> -->
                    </div>
                    <div class="main-content-section-upper">
                        <div class="main-content-section-upper-top">
                            <h3>Scheduled Call</h3>
                            <div class="two-sections">
                                <ul class="left-section">
                                    <li><img src="{{ asset('assets/images/visits/doc.png') }}" alt="doc">Weight loss </li>
                                    <li><img src="{{ asset('assets/images/visits/white-cal.png') }}" alt="doc">30 April,2021, 9:15am-10:15am</li>
                                </ul>
                                <div class="right-section">
                                    <a class="btn white" href="javascript:void(0)">Reschedule</a>
                                    <a class="btn" href="javascript:void(0)">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            @isset($userdata)
                                @php
                                    if (!is_array($userdata)) {
                                        $userdata = [];
                                    }
                                @endphp
                                @foreach ($userdata as $data)
                                    <div class="main-content-section-upper" id="doc_list">
                                        <div class="main-content-section-upper-bottom">
                                            <div class="profile-icon">
                                                @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                <div>
                                                    @if(!empty($data->prescriber_firstname))
                                                        <span class="main">{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}</span>
                                                    @endif
                                                    <span class="sub">{{ $data->diagnosis? $data->diagnosis:'' }}</span>
                                                </div>
                                            </div>
                                            <div class="reschedule-right-btn">
                                                <a class="btn green providerDetailButton" href="javascript:void(0)" doc_info='{{ json_encode($data) }}' data-toggle="modal" data-target="#viewproviderDetailsModal">View Provider Details</a>
                                                {{-- <a class="circle" href="javascript:void(0)"><img src="{{asset('assets/images/visits/phone.png')}}" alt="phone"></a> --}}
                                                @if(strtolower($data->state)=='arkansas' || strtolower($data->state)=='new jersey')
                                                <a class="circle" target="_blank" href="{{ $data->audio_calendly_link }}">
                                                <img src="{{ asset('assets/images/visits/phone.png') }}" alt="phone"></a>
                                                @endif
                                               
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- @endif --}}
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- popup -->
        <div class="modal fade mint-popup providerDetailsModal" id="viewproviderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="provider-header">
                        <img id="doctor_image_default" src="{{asset('assets/images/messages/2.png')}}" alt="profile" style="height: 40px;width: 40px;object-fit: cover;display:none;">
                            <img id="doctor_image" src="" alt="profile" style="width:114px;height:114px;object-fit:cover;">
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
                            <input type="text" class="form-control" id="diagnosis" aria-describedby="emailHelp" value="Family medicine, general medicine and endocrinologist" disabled>
                        </div>
                        <h2>Bio</h2>
                        <div class="form-group">
                            <textarea type="text" class="form-control" id="prescriber_bio" aria-describedby="emailHelp" value="" disabled></textarea>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button>
                        <button type="button" id="logoutButton" class="btn btn-primary modal-btn">Logout</button>
                    </div> -->
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
        $("#schCall").click(function() {
            $('html, body').animate({
                scrollTop: $("#doc_list").offset().top
            }, 200);
        });
        $('.providerDetailButton').click(function() {
            var doc_info = $(this).attr('doc_info');
            doc_info = JSON.parse(doc_info);
            console.log(doc_info);
            $('#prescriber_phonenumber').val(doc_info['prescriber_phonenumber']?doc_info['prescriber_phonenumber']:'');
            $('#prescriber_email').val(doc_info['prescriber_email']?doc_info['prescriber_email']:'');
            $('#prescriber_bio').val(doc_info['prescriber_bio'] ? doc_info['prescriber_bio'] : '');
            $('#diagnosis').val(doc_info['diagnosis']?doc_info['diagnosis']:'');
            if(doc_info['prescriber_firstname']!='' && doc_info['prescriber_firstname']!=null){
                $('#doctor_name').val(doc_info['prescriber_firstname'] + ' ' + doc_info['prescriber_lastname']);
            }else{
                $('#doctor_name').val();
            }
            if(doc_info['doc_image']!='' && doc_info['doc_image']!=null){
                var img=document.getElementById('doctor_image');
            img.src="data:image/png;base64,"+doc_info['doc_image'];
            }else{
                $('#doctor_image').hide();
                $('#doctor_image_default').show();
            }
           
          });
    </script>
</body>
</html>