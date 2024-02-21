<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Oracle Sound Lab</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="WebKhu">
    <link type="text/css" rel="stylesheet" href="{!! url('css/styler.css') !!}">
    <link type="text/css" rel="stylesheet" href="{!! url('css/modalPopup.css') !!}">
    <link type="text/css" rel="stylesheet" href="{!! url('css/owl.carousel.min.css') !!}">
    <link type="image/png" rel="icon" href="{!! url('template/favico.png') !!}" sizes="256x256">
</head>

<body>
    {{-- Header Bar --}}
    @include('template.header')
    {{-- Sidebar --}}
    @include('template.sidebar')
    {{-- Content Area --}}
    <div class="right-area">
        <div class="content">
            {{-- Breadcrumb --}}
            @include('template.breadcrumb')
            {{-- Page Content --}}
            @yield('content')
            {{-- Partners Area  --}}
        {{-- @include('template.partner') --}}
        </div>
        {{-- Footer Area  --}}
        @include('template.footer')
    </div>
    <script src="{!! url('js/bootstrap.bundle.js') !!}"></script>
    <script src="{!! url('js/jquery.min.js') !!}"></script>
    <script src="{!! url('js/owl.carousel.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sidebar li.has-sub a').click(function() {
                if ($(this).parent().hasClass('open')) {
                    $(this).parent().removeClass('open');
                } else {
                    $(this).parent().addClass('open');
                }
            });

            $('.carousel').carousel({
                interval: 8000, // Waktu perpindahan gambar (ms)
                pause: true // Jika true, slideshow akan berhenti saat cursor berada di atasnya
            });

            $(".owl-carousel.partners").owlCarousel({
                margin: 20,
                loop: true,
                items: 2,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 900,
                autoplayHoverPause: true,
                lazyLoad: true,
                responsiveClass: true,
                responsive: {
                    1760: {
                        items: 8,
                    },
                    1440: {
                        items: 7,
                    },
                    992: {
                        items: 6,
                    },
                    767: {
                        items: 5,
                    },
                    576: {
                        items: 4,
                    },
                    400: {
                        items: 3,
                    },
                }
            });

        });

        function myFunction(x) {
            x.classList.toggle("change");
            document.getElementById('sidebar').classList.toggle('hide');
        }

        function openSearch() {
            document.getElementById('search-sm').classList.toggle('show');
            if (document.getElementById('sidebar').classList.contains('hide')) {
                document.getElementById('sidebar').classList.toggle('hide');
                document.getElementById('close-toggle').classList.toggle("change");
            }
        }

        function openBlank(x) {
            console.log(x);
            window.open(x);
        }
    </script>
</body>

</html>
