<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login to your account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('assets/fonts/primary-fonts.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/third-party/animation/aos.css') }}" type="text/css" rel="stylesheet" media="screen" />
    <link href="{{ asset('assets/css/registration.css') }}" type="text/css" rel="stylesheet" media="screen" />
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
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login"><img src="{{ env('APP_LOGO') }}" alt="logo"></a>
        </nav>
    </header>
    <section>
        <div class="section-inner">
            <div class="logged-out-pare">
                <div class="logged-out">
                    <p>{{ $msg }}</p>
                    <a href="{{ env('APP_URL') }}/login" class="btn">Login here</a>
                </div>
            </div>
        </div>
    </section>

    {{-- including the scripts --}}
    @include('js_scripts.bottom_scripts')

</body>
</html>