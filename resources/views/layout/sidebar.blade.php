<link href="{{ asset('assets/css/sidebar.css') }}" type="text/css" rel="stylesheet" media="screen" />

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

<div id="menu-icon" class="menu-icon">
    <img class="menu-icon-img" src="{{ asset('assets/images/common/icon.png') }}" />
    <div class="sidebr-overlay"></div>
    <div id="sidebar">
        <ul class="upper-listing sidebar-listing">
            <li><a class="{{ Request::url() == env('APP_URL') . '/visits' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/visits" title="My Visits">
                <img src="{{ asset('assets/images/sidebar/visits.png') }}" alt="visits">
                <span>My Visits</span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/messages' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/messages" title="My Messages">
                <img src="{{ asset('assets/images/sidebar/messages.png') }}" alt="messages">
                <span>My Messages</span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/tests' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/tests" title="My Tests">
                <img src="{{ asset('assets/images/sidebar/tests.png') }}" alt="tests">
                <span> My Tests </span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/schedule' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/schedule" title="My Appointments">
                <img src="{{ asset('assets/images/sidebar/phone.png') }}" alt="call">
                <span>My Appointments</span></a>
            </li>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/orders' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/orders" title="Orders">
                <img src="{{ asset('assets/images/sidebar/orders.png') }}" alt="orders"><span> Orders </span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/profile' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/profile" title="My Profile">
                <img src="{{ asset('assets/images/sidebar/profile.png') }}" alt="profile"><span>My Profile</span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/logout' ? 'active' : '' }}" href="javascript:void(0)" title="Logout" data-toggle="modal" data-target="#logoutModal">
                <img src="{{ asset('assets/images/sidebar/logout.png') }}" alt="logout">
                <span>Logout</span></a>
            </li>
        </ul>

        <ul class="bottom-listing sidebar-listing">
            <li><a class="{{ Request::url() == env('APP_URL') . '/faq' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/faq" title="FAQs">
                <img src="{{ asset('assets/images/sidebar/faq.png') }}" alt="faq">
                <span>FAQs</span></a>
            </li>
            <li><a class="{{ Request::url() == env('APP_URL') . '/contact_us' ? 'active' : '' }} loader_class" href="{{ env('APP_URL') }}/contact_us" title="Contact us">
                <img src="{{ asset('assets/images/sidebar/contact.png') }}" alt="contact">
                <span>Contact us</span></a>
            </li>
        </ul>
    </div>
    <!-- modal -->
    <div class="modal fade mint-popup" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    Do you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn modal-border-btn" data-dismiss="modal">Go back</button>                        <button type="button" id="logoutButton" class="btn btn-primary modal-btn">Logout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
    document.getElementById("logoutButton").onclick = function() {
        location.href = "{{ env('APP_URL') }}/logout";
    };

    document.getElementById("menu-icon").onclick = function() {
        $("body").toggleClass("menu-show");
        $("#sidebar").toggleClass("show");
        $(".sidebr-overlay").toggleClass("show");
    };
</script>