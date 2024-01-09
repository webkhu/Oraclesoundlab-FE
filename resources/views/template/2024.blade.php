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
    {{-- Header Bar --}}
    <div class="header" role="navigation">
        <div class="navbar-header">
            <!-- Search Bar -->
            <form>
                <div class="input-group input-group-sm search">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <!-- Colapse Menu -->
            <div class="close-toggler" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
    </div>
    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        {{-- logo --}}
        <div class="logo"><img id="logo" src="{{ $url }}//template/oraclesoundlab_logo.gif"></div>
        {{-- Menu Area--}}
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
                                <li><a href="{{ $url }}/{{ $subpage->name }}"><i class="bi bi-dash"></i>{{ $subpage->link }}</a></li>
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
    {{-- Content Area --}}
    <div class="right-content">        
        {{-- Page Content --}}
        @yield('content')
    </div>
    <script src="{!! url('/js/bootstrap.bundle.js') !!}"></script>
    <script src="{!! url('/js/jquery.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.sidebar li.has-sub a').click(function () {
                if ($(this).parent().hasClass('open')) {
                    $(this).parent().removeClass('open');
                } else {
                    $(this).parent().addClass('open');
                }
            });
        });
        
        function myFunction(x) {
            x.classList.toggle("change");
            document.getElementById('sidebar').classList.toggle('hide');
        }
    </script>
</body>

</html>