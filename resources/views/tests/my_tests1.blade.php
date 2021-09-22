<!DOCTYPE html>

<html lang="en">

<head>
  <title>My Tests</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="{{asset('assets/fonts/primary-fonts.css')}}" type="text/css" rel="stylesheet" media="screen" />
  <link href="{{asset('assets/third-party/bootstrap/dist/css/bootstrap-grid.min.css')}}" type="text/css" rel="stylesheet"
    media="screen" />
  <link href="{{asset('assets/third-party/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet"
    media="screen" />
  <link href="{{asset('assets/third-party/animation/aos.css')}}" type="text/css" rel="stylesheet" media="screen" />
  <link href="{{asset('assets/css/my-tests.css')}}" type="text/css" rel="stylesheet" media="screen" />

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

<body class="common-pages">
  
  @include('layout.header')

  <section>
    <div class="section-inner">

      @include('layout.sidebar')
      
      <div class="main-content-section test-page">
        <h2>My Tests <div class="test-btns"><a class="btn white" href="javascript:void(0)" data-toggle="modal"
              data-target="#uploadsmodal"><img src="{{asset('assets/images/tests/upload.png')}}" alt="upload">Upload Your Physical
              Tests</a>
            <a class="btn white" href="javascript:void(0)" data-toggle="modal" data-target="#viewmodal">View Physical
              Tests</a>
          </div>
        </h2>

        <!-- Modal -->
        <div class="modal fade common-modal view-modal" id="viewmodal" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
                <div class="modal-success-content">
                  <div class="modal-upper-content-left">
                    <p class="modal-link"><img src="{{asset('assets/images/tests/pin.png')}}" /></p>
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
        <div class="modal fade common-modal success-modal" id="successmodal" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p class="modal-link"><img src="{{asset('assets/images/tests/pin.png')}}" /></p>
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
        <div class="modal fade common-modal upload-modal" id="uploadsmodal" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <a href="#" class="drop-file">
                  <input type="file" />
                  <img src="{{asset('assets/images/tests/cloud.png')}}" />
                  <p>Drop files here (OR) Click to Upload</p>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="main-content-section-inner">
          <div class="search-bar">
            <img src="{{asset('assets/images/common/search.png')}}" alt="search">
            <input class="form-control search" type="search" placeholder="Search a medical test" aria-label="Search">
          </div>
          <div class="scroller-list">
            <div class="test-heading">
              <span class="text">Today visit</span>
              <span class="line"></span>
            </div>
            <ul class="test-listing">
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Herman Ryan</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">General medicine</span>
                      <span class="sub">2 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Herbert Reynolds</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">General medicine</span>
                      <span class="sub">2 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Jeffery Nichols</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Effie Chavez</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Endocrinologist</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Sallie Porter</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Chris McDaniel</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Endocrinologist</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
            </ul>
            <div class="test-heading">
              <span class="text">22 April 2021</span>
              <span class="line"></span>
            </div>
            <ul class="test-listing">
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Herman Ryan</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">2 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Herbert Reynolds</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">2 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Jeffery Nichols</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">General medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Effie Chavez</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Sallie Porter</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">General medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
              <li class="test-list">
                <div class="test-list-inner">
                  <div class="header">
                    <span class="name">Dr. Chris McDaniel</span>
                    <a class="dot-image" href="javascript:void(0)"><img src="{{asset('assets/images/visits/dots.png')}}"
                        alt="dot-img"></a>
                  </div>
                  <span class="middle-line"></span>
                  <div class="bottom">
                    <div>
                      <span class="main">Family medicine</span>
                      <span class="sub">3 hours ago</span>
                    </div>
                    <a class="btn white" href="javascript:void(0)">View result</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- including the scripts --}}
  @include('js_scripts.bottom_scripts')

  <script>
    // app url for global search
    var app_url = "{{ env("APP_URL") }}"

    
    $(document).ready(function () {
      AOS.init();
    });
  </script>
</body>

</html>