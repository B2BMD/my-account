<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/my-messages.css') }}" type="text/css" rel="stylesheet" media="screen" />

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

            <div class="main-content-section message-page">
                <h2>My Messages</h2>
                <div class="main-content-section-inner">
                    <div class="left-side-users">
                        <ul class="contact-list">
                            @isset($userdata)
                                @php
                                    if (!is_array($userdata)) {
                                        $userdata = [];
                                    }
                                @endphp
                                @foreach ($userdata as $data)
                                    <li class="activeDoctor">
                                        <a href="javascript:void(0)" class="doc_messages" casenum="{{ $data->case_number }}" doc_info='{{ json_encode($data) }}'>
                                            <div class="user">
                                                @if(empty($data->doc_image))
                                                    <img src="{{asset('assets/images/messages/2.png')}}" alt="{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}" style="height: 40px;width: 40px;object-fit: cover;">
                                                @else
                                                    <img src="data:image/png;base64,{{$data->doc_image}}" alt="{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}" style="height: 40px;width: 40px;object-fit: cover;">
                                                @endif
                                                <!-- <img src="{{ asset('assets/images/messages/6.png') }}" alt="{{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}"> -->
                                                <div class="text">
                                                    <p class="name">
                                                        @if(!empty($data->prescriber_firstname))
                                                            {{ $data->prescriber_firstname . ' ' . $data->prescriber_lastname }}
                                                        @endif
                                                        <span class="category">{{ $data->diagnosis?$data->diagnosis:'' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                    <div class="right-side-chatbox" style="display: none">
                        <!-- TOP-BAR -->
                        <div class="topbar">
                            <div class="content">
                                <div class="left">
                                    <img  id="personImage" alt="doc" style="width: 40px;height:40px;object-fit:cover;">
                                    <img id="personImageDefault" src="{{ asset('assets/images/messages/2.png') }}" class="pic" alt="" style="width: 40px;height:40px;object-fit:cover;display:none;">
                                    <h2 id="personName">Bobby Wagner</h2>
                                </div>
                                <div class="right">
                                    <button class="btn view-detail" data-toggle="modal" data-target="#providerDetailsModal">View Provider Details</button>
                                    {{-- <button class="btn call-btn"><img src="{{asset('assets/images/messages/call.png')}}" alt=""></button> --}}
                                    {{-- <button class="btn video-call-btn"><img src="{{asset('assets/images/messages/video-call.png')}}" alt=""></button> --}}
                                </div>
                            </div>
                        </div>

                        <!-- MESSAGES -->
                        <div class="messages-box">
                            <!-- <div class="day">
                                <p>TODAY</p>
                            </div> -->
                            <div class="message-inner">
                                <div class="message-inne-inner"> </div>
                                <div class="send-box">
                                    <div class="inner">
                                        <input id="message_area" type="text" class="form-control send-input" name="message" placeholder="Start typing here">
                                        <button class="btn send-btn" id="send_button" style="display:none"><img src="{{ asset('assets/images/messages/send-img.png') }}" alt=""></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Provider detail modal -->

        <div class="modal fade mint-popup providerDetailsModal" id="providerDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="provider-header">
                            <img  id="modalImage" alt="doc" style="width: 40px;height:40px;object-fit:cover;">
                            <img id="modalImageDefault" src="{{ asset('assets/images/messages/2.png') }}" class="pic" alt="" style="width: 40px;height:40px;object-fit:cover;display:none;">
                            
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
        <div class="modal fade mint-popup" id="ErrorMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                    <span id="resMessage"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button> 
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

        var currentCaseNum = null;
        $(document).ready(function() {
            AOS.init();
            $('.contact-list > li').first().find('a').trigger('click')
        });
        $(document).on('click', '.activeDoctor', function() {
            $('.activeDoctor').removeClass('active');
            $(this).addClass('active');
        });
        $(document).on('keyup', '#message_area', function(e) {
            if ($.trim($('#message_area').val()) == "") {
                $('#send_button').hide();
            } else {
                $('#send_button').show();
                if (e.which == 13) {
                    $('#send_button').click();
                }
            }
        });
        $(document).on('click', '.doc_messages', function() {
            $('.loader').show();
            $(".right-side-chatbox").show();

            // $('.loader').addClass('loader-show');
            var doc_info = $(this).attr('doc_info');
            doc_info = JSON.parse(doc_info);

            // $(".message-inne-inner").html(""); 
            // $(".message-inne-inner").html('<img height="60" width="60" style="position: absolute;right: 45%;" src="https://dportek.com/img/design/loading.gif"></img> ');
            // using CURL to get messages
            currentCaseNum = $(this).attr('casenum');
            var url = "{{ env('APP_URL') . '/get_messages' }}"
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    casenum: $(this).attr('casenum')
                },
                success: function(response) {
                    // $(".message-inne-inner").html(""); 
                    function formatAMPM(date) {
                        date = new Date(date);
                        var hours = date.getHours();
                        var minutes = date.getMinutes();
                        var ampm = hours >= 12 ? 'pm' : 'am';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // the hour '0' should be '12'
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        var strTime = hours + ':' + minutes + ' ' + ampm;
                        return strTime;
                    }
                    response = JSON.parse(response);
                    console.log(response);
                    if(doc_info['doc_image']!='' && doc_info['doc_image']!=null){
                        var img=document.getElementById('personImage');
                        var img1=document.getElementById('modalImage');
                        img.src="data:image/png;base64,"+doc_info['doc_image'];
                        img1.src="data:image/png;base64,"+doc_info['doc_image'];

                        
                    }else{
                        $('#personImageDefault').show();
                        $('#personImage').hide();
                        $('#modalImageDefault').show();
                        $('#modalImage').hide();
                    }
                    if(doc_info['prescriber_firstname']!='' && doc_info['prescriber_firstname']!=null){
                        $('#personName').html(doc_info['prescriber_firstname'] + ' ' + doc_info['prescriber_lastname']);
                    }else{
                        $('#personName').html();
                    }
                    $('#prescriber_phonenumber').val(doc_info['prescriber_phonenumber']?doc_info['prescriber_phonenumber']:'');
                    $('#prescriber_email').val(doc_info['prescriber_email']?doc_info['prescriber_email']:'');
                    $('#prescriber_bio').val(doc_info['prescriber_bio'] ? doc_info['prescriber_bio'] : '');
                    $('#diagnosis').val(doc_info['diagnosis']?doc_info['diagnosis']:'');
                    if(doc_info['prescriber_firstname']!='' && doc_info['prescriber_firstname']!=null){
                        $('#doctor_name').val(doc_info['prescriber_firstname'] + ' ' + doc_info['prescriber_lastname']);

                    }else{
                        $('#doctor_name').val();
                    }
                    
                    // console.log(response.data);
                    if ((response.data == '') || (response.data == null)) {
                        $('.loader').hide();
                        $(".message-inne-inner").html("");
                        return;
                    }
                    var jsonArr = Object.keys(response.data).map(function(key) {
                        return response.data[key];
                    });

                    response.data1 = jsonArr.reverse();
                    // console.log(response.data1);
                    $('.loader').hide();

                    for (const [key, message] of Object.entries(response.data1)) {

                        if (message.doc == 1) {
                            var div = `
                                <div class="message other-user">
                                    <p class="time"> ` + response.data.doc_name + ` <span> ` + formatAMPM(message.timestamp) + ` </span></p>
                                    <div class="textbox">
                                    <h5 class="text">` + message.note + `</h5>
                                    </div>
                                </div>
                                `;
                            $(".message-inne-inner").append(div);
                        } else if (message.pat == 1) {
                            var div = `
                                <div class="message me">
                                    <p class="time"> ` + response.data.pat_name + ` <span> ` + formatAMPM(message.timestamp) + ` </span></p>
                                    <div class="textbox">
                                    <h5 class="text">` + message.note + `</h5>
                                    </div>
                                </div>
                                `;
                            $(".message-inne-inner").append(div);
                        }
                    }
                    $(".message-inne-inner").scrollTop($(".message-inne-inner")[0].scrollHeight);
                }
            });
        });

        $(document).on('click','.send-btn', function(){
          $('#send_button').hide();
          $('.loader').show();
          window.addEventListener('offline', () => {
            $('.loader').hide();
          });

          $('#send_button').attr('disabled',true);
          var message = $("[name='message']").val();
          
          var url = "{{env('APP_URL').'/send_message'}}"
          $.ajax({
          url: url,
          type: 'post',
          data: {
            _token:'{{ csrf_token() }}',
            message: message,
            casenum: currentCaseNum
          },
          success: function(response){
                    var res=JSON.parse(response);
                    $('.loader').hide();
                    $('#send_button').attr('disabled',false);
                   
                    if(res.status==0){
                        $('#resMessage').html(res.message);
                        $('#ErrorMessageModal').modal({
                                show:true
                            });
                    }else if(res.status==2){
                        $('#resMessage').html(res.message);

                        $('#ErrorMessageModal').modal({
                                show:true
                            });
                    } else if(res.status==1){
                      
                        var div = `
                                <div class="message me">
                                <p class="time">  <span></span></p>
                                <div class="textbox">
                                    <h5 class="text">` + message + `</h5>
                                </div>
                                </div>
                            `;
                        $(".message-inne-inner").append(div); 
                        $("[name='message']").val("");
                        $(".message-inne-inner").scrollTop($(".message-inne-inner")[0].scrollHeight);
                                    }
                        },
                        error:function(response){
                            $('.loader').hide();
                            $('#send_button').attr('disabled',false);

                            $('#resMessage').html("Something went wrong");

                            $('#ErrorMessageModal').modal({
                                    show:true
                                });
                        },
                        fail:function(response){
                            $('.loader').hide();
                            $('#send_button').attr('disabled',false);

                            $('#resMessage').html("Something went wrong");

                            $('#ErrorMessageModal').modal({
                                    show:true
                                });
                        }
                });
        });
  </script>
</body>
</html>