<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Oracle Sound Lab</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width">
    <link type="text/css" rel="stylesheet" href="{!! url('/icon/bootstrap-icons.css') !!}">    
    <link type="text/css" rel="stylesheet" href="{!! url('/css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! url('/css/styler.css') !!}">
</head>

<body>
    <div class="left-sidebar">
        <!-- Navbar -->
        <ul class="menu">
            <li class="active"><a href="#"><i class="bi bi-house-fill"></i>Home</a></li>
            <li class="has-sub open">
                <a href="javascript:;">
                    <i class="bi bi-people-fill"></i>Artists<div class="pull-right"><span class="caret"></span></div>
                </a>
                <ul class="submenu">
                    <li><a href="#"><i class="bi bi-dot"></i>Service 1</a></li>
                    <li><a href="#"><i class="bi bi-dot"></i>Service 2</a></li>
                    <li><a href="#"><i class="bi bi-dot"></i>Service 3</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="bi bi-person-lines-fill"></i>Contact</a></li>
        </ul>
    </div>
    <div class="right-content">
        @yield('content')
    </div>
    <script src="{!! url('/js/bootstrap.bundle.js') !!}"></script>
    <script src="{!! url('/js/jquery.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Sidebar menu 
            $('.left-sidebar li.has-sub a').click(function () {
                if ($(this).parent().hasClass('open')) {
                    $(this).parent().removeClass('open');
                } else {
                    $(this).parent().addClass('open');
                }
            });
        });
    </script>
</body>

</html>