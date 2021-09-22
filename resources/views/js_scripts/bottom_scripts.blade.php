<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>


{{-- <script src="{{asset('assets/js/jquery-1.19.3.validate.js')}}"></script> --}}
<script src="{{ asset('assets/js/jquery-1.19.3.validate.min.js') }}"></script>
{{-- <script src="{{asset('assets/js/jquery-1.19.3.additional-methods.js')}}"></script> --}}
<script src="{{ asset('assets/js/jquery-1.19.3.additional-methods.min.js') }}"></script>

{{-- <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}" type="text/javascript"></script> --}}
<script src="{{ asset('assets//third-party/bootstrap/dist/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/third-party/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-selectbox.js') }}"></script>
<script src="{{ asset('assets/third-party/animation/aos.js') }}"></script>
{{-- using lzstring --}}
<script language="javascript" src="{{ asset('js/lz-string-master/libs/lz-string.js') }}"></script>
<script src="{{ asset('assets/js/global_search.js') }}"></script>

<script src="{{ asset('assets/js/jquery-form-4.3.0.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Loader in sidebar
        $('.loader_class').click(function() {
            $('.loader').show();
        });
        
        // menu icon toggle
        // $(document).on('click', function (e) {
        //     if ($('#sidebar').hasClass('show')) {
        //         $('#sidebar').removeClass('show');
        //         $('body').removeClass('menu-show');
        //         $('.sidebr-overlay').removeClass('show');
        //     }
        // });

        $(document).mouseup(function(e) 
        {
            var container = $("#sidebar");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                $("body").removeClass("menu-show");
                $("#sidebar").removeClass("show");
                $(".sidebr-overlay").removeClass("show");
            }
        });
    });
</script>
