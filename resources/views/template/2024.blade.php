<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Oracle Sound Lab</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width">
    <link type="text/css" rel="stylesheet" href="{!! url('css/styler.css') !!}">
    <link type="text/css" rel="stylesheet" href="{!! url('css/modalPopup.css') !!}">
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
        </div>{{-- Footer Area  --}}
        @include('template.partner')
        {{-- Footer Area  --}}
        @include('template.footer')
    </div>
    <script src="{!! url('js/bootstrap.bundle.js') !!}"></script>
    <script src="{!! url('js/jquery.min.js') !!}"></script>
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
    </script>
</body>

</html>
