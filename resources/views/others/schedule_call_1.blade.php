<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schedule Call</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/schedule-call.css') }}" type="text/css" rel="stylesheet" media="screen" />
</head>
<body class="common-pages">

    @include('layout.header')

    <section>
        <div class="section-inner">

            @include('layout.sidebar')

            <div class="main-content-section schedule-call">
                <h2>Schedule a call</h2>
                <div class="main-content-section-inner">
                    <h4>Your Upcoming Appointments</h4>
                    <textarea placeholder="Please type what you need."></textarea>

                    <div class="drops">
                        <div class="dropdown service">
                            <button class="btn dropdown service-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Service </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Cardiologist</a>
                                <a class="dropdown-item" href="#">Neurosurgeon</a>
                                <a class="dropdown-item" href="#">Dentist</a>
                                <a class="dropdown-item" href="#">Psychiatrist</a>
                                <a class="dropdown-item" href="#">Urologist</a>
                                <a class="dropdown-item" href="#">Surgeon</a>
                                <a class="dropdown-item" href="#">Oncologist</a>
                                <a class="dropdown-item" href="#">Orthopedician</a>
                                <a class="dropdown-item" href="#">Gynecologist</a>
                            </div>
                        </div>
                        <div class="dropdown date&time">
                            <button class="btn dropdown" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Choose Date & Time </button>
                        </div>
                    </div>
                    <div class="add-files">
                        <h4>Add any additional files (prescriptions, test results, etc.)</h4>
                        <div class="drop-file">
                            <div class="drop-file-inner">
                                <input type="file">
                                <img id="blah" src="{{ asset('assets/images/tests/cloudnew.png') }}" alt="your image" />
                                <span class="sub">Click here to Upload image</span>
                            </div>
                        </div>
                    </div>
                    <div class="submit-box">
                        <button class="btn submit-btn"><a href="{{ env('APP_URL') }}/schedule"> Submit </a></button>
                        <button class="btn cancel-btn"><a href="{{ env('APP_URL') }}/schedule"> Cancel </a></button>
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