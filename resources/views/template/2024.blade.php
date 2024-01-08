<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Oracle Sound Lab</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width"> 
    <link rel="stylesheet" href="{!! url('/css/styler.css') !!}">
</head>

<body>
    <div class="left-sidebar">
        <div class="logo"><img id="logo" src="{{ $url }}//template/oraclesoundlab_logo.gif"></div>
        <!-- Navbar -->
        <div class="menu-area">
            <ul class="menu">
                @foreach($pages as $page)
                    @php 
                    if($active === $page->name){
                        $cl = 'active';
                    } else {
                        $cl ='';
                    }
                    @endphp
                    @if (collect($subpages)->flatten()->where('parent_id', $page->id)->last())                
                        <li class="has-sub {{ $cl }}">
                            <a href="javascript:;">
                                @if(isset($page->icon))<i class="{{ $page->icon }}"></i>@endif {{ $page->link }}<div class="float-end"><i class="bi bi-caret-down-fill" style="font-size: 0.7em"></i></div>
                            </a>
                            <ul class="submenu">
                                @foreach($subpages as $subpage)
                                <li><a href="{{ $url }}/{{ $subpage->name }}"><i class="bi bi-dot"></i>{{ $subpage->link }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else                
                        <li class= {{ $cl }}><a href="{{ $url }}/{{ $page->name }}">
                            @if(isset($page->icon))<i class="{{ $page->icon }}"></i>@endif{{ $page->link }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
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