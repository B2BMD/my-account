<header>
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
    <nav class="navbar navbar-expand-lg">
        @if (Auth::user())
            <a class="navbar-brand" href="{{ env('APP_URL') }}/visits" id="visitsPage">
                <img src="{{ env('APP_LOGO_2') }}" alt="logo">
            </a>
        @else
            <a class="navbar-brand" href="{{ env('APP_URL') }}/login">
                <img src="{{ asset('assets/images/common/logo-2.png') }}" alt="logo">
            </a>
        @endif
        <div id="myDropdown" class="search-bar dropdown-content">
            <img src="{{ asset('assets/images/common/search.png') }}" alt="search">
            <input class="form-control search" type="search" placeholder="Search doctors or medical department" aria-label="Search" id="myInput">
            <div class="dropdown-content-inner" id="dropdown-inner">
                {{-- anchor tags --}}
            </div>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <!-- <img class="bell-icon" src="{{ asset('assets/images/common/notification.png') }}" alt="notif"> -->
            <a class="profile-icon" id="profile_icon" href="{{ env('APP_URL') }}/profile" style="color:#212529">
                <!-- <a href="{{ env('APP_URL') }}/profile"> -->
                <img class="profile_picture" src=" {{ file_exists(public_path('assets/images/profile/profile_images/' . Auth::user()->id . '/' . Auth::user()->image_path)) ? asset('assets/images/profile/profile_images/' . Auth::user()->id . '/' . Auth::user()->image_path) : asset('assets/images/profile/profile.png') }}" alt="{{ Auth::user()->name }}" height="40" width="40">
                <div>
                    <span class="main">{{ Auth::user()->name ?? '' }}</span>
                    <span class="sub">PATIENT</span>
                </div>
            </a>
        </form>
    </nav>
</header>
<link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
<script>
    document.getElementById("visitsPage").onclick = function() {
        $('.loader').show();
    };
    document.getElementById("profile_icon").onclick = function() {
        $('.loader').show();
    };
</script>