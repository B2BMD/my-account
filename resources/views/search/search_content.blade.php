<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Filter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/my-profile.css') }}" type="text/css" rel="stylesheet" media="screen" />

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

            <div class="main-content-section doctor-page">
                <h2>{{ $filtered_info['type'] }} description</h2>
                <div class="main-content-section-inner">

                    <div class="main-content-section-right">
                        <div class="main-content-section-right-inner">
                            <h2 class="type">{{ $filtered_info['type'] }} details</h2>
                            <div class="doctor-page-inner">
                                <div class="doctor-detail">
                                    <p class="type">{{ $filtered_info['type'] }} name</p>
                                    <span id="type_name"> Type Name </span>
                                </div>
                                {{-- details in case of doctor --}}
                                @if ($filtered_info['type'] == 'Doctor')
                                    <div class="doctor-detail">
                                        <p>Speciality</p>
                                        <span id="speciality"> Speciality </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Email</p>
                                        <span id="prescriber_email"> Email </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Phone</p>
                                        <span id="prescriber_phone"> Phone </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Bio</p>
                                        <span id="prescriber_bio"> Bio </span>
                                    </div>
                                @endif

                                {{-- details in case of diagnosis --}}
                                @if ($filtered_info['type'] == 'Diagnosis')
                                    <div class="doctor-detail">
                                        <p>Medications</p>
                                        <span id="medication"> Medications </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Height</p>
                                        <span id="height"> Height </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Weight</p>
                                        <span id="weight"> Weight </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Allergies</p>
                                        <span id="allergies"> Allergies </span>
                                    </div>
                                @endif

                                {{-- details in case of medicine --}}
                                @if ($filtered_info['type'] == 'Medicine')
                                    <div class="doctor-detail">
                                        <p>Treatment</p>
                                        <span id="treatment"> Treatment </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Pill Count</p>
                                        <span id="pills"> Pills </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Dispense</p>
                                        <span id="dispense"> Dispense </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Refills</p>
                                        <span id="refill"> Refills </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Days Supply</p>
                                        <span id="supply"> Supply </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>NDC</p>
                                        <span id="ndc"> NDC </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Subscription Plans</p>
                                        <span id="subscription"> Subscription Plans </span>
                                    </div>
                                    <div class="doctor-detail">
                                        <p>Notes</p>
                                        <span id="note"> Notes </span>
                                    </div>
                                @endif
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

        // editing the contents of the page via local storage
        $(document).ready(function() {
            // storing the filtered info['case_number'] in a variable
            var case_number = '<?php echo $filtered_info['case_number']; ?>';
            var type = '<?php echo $filtered_info['type']; ?>';

            for (var i = 0; i < users.length; i++) {
                if (users[i]["case_number"] == case_number) {
                    // doctor case
                    if (type == 'Doctor') {
                        // showing doctor name
                        $('#myInput').val(users[i]["prescriber_firstname"] + ' ' + users[i]["prescriber_lastname"]);
                        $('#type_name').html(users[i]["prescriber_firstname"] + ' ' + users[i]["prescriber_lastname"]);
                        // showing speciality
                        $('#speciality').html(users[i]["diagnosis"] ? users[i]["diagnosis"] : 'NA');
                        // email
                        $('#prescriber_email').html(users[i]["prescriber_email"] ? users[i]["prescriber_email"] : 'NA');
                        // phone
                        $('#prescriber_phone').html(users[i]["prescriber_phonenumber"] ? users[i]["prescriber_phonenumber"] : 'NA');
                        // bio
                        $('#prescriber_bio').html(users[i]["prescriber_bio"] ? users[i]["prescriber_bio"] : 'NA');
                    }
                    // Diagnosis case
                    if (type == 'Diagnosis') {
                        $('#myInput').val(users[i]["medications"]);
                        // showing Diagnosis name
                        $('#type_name').html(users[i]["diagnosis"] ? users[i]["diagnosis"] : 'NA');
                        // medication
                        $('#medication').html(users[i]["medications"] ? users[i]["medications"] : 'NA');
                        // Height
                        $('#height').html(users[i]["height"] ? users[i]["height"] : 'NA');
                        // weight
                        $('#weight').html(users[i]["weight"] ? users[i]["weight"] : 'NA');
                        // allergies
                        $('#allergies').html(users[i]["allergies"] ? users[i]["allergies"] : 'NA');
                    }
                    // Medicine case
                    if (type == 'Medicine') {
                        // showing medicine name
                        $('#myInput').val(users[i]["actual_prescription_name"]);
                        $('#type_name').html(users[i]["actual_prescription_name"] ? users[i]["actual_prescription_name"] : 'NA');
                        // treatment
                        $('#treatment').html(users[i]["requested_treatment_name"] ? users[i]["requested_treatment_name"] : 'NA');
                        // pills
                        $('#pills').html(users[i]["quantity"] ? users[i]["quantity"] : 'NA');
                        // dispense
                        $('#dispense').html(users[i]["dispense_units"] ? users[i]["dispense_units"] : 'NA');
                        // refills
                        $('#refill').html(users[i]["refills"] ? users[i]["refills"] : 'NA');
                        // supply
                        $('#supply').html(users[i]["days_supply"] ? users[i]["days_supply"] : 'NA');
                        // NDC
                        $('#ndc').html(users[i]["NDC"] ? users[i]["NDC"] : 'NA');
                        // subscription
                        $('#subscription').html(users[i]["subscription"] ? users[i]["subscription"] : 'NA');
                        // notes
                        $('#note').html(users[i]["notes"] ? users[i]["notes"] : 'NA');
                    }
                }
            }
        });
    </script>
</body>
</html>