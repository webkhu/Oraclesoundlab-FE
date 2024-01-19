<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Oracle Sound Lab</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width">
    <link type="text/css" rel="stylesheet" href="{!! url('/css/styler.css') !!}">
    <link type="text/css" rel="stylesheet" href="{!! url('/css/modalPopup.css') !!}">
</head>

<body>
    {{-- Header Bar --}}
    <div class="header" role="navigation">
        <div class="header-nav">
            <div class="header-box header-box-sm">
                <img class="header-logo" src="{{ $url }}//template/oraclesoundlab_logo.gif">
            </div>
            <!-- Search Bar -->
            <div class="header-box header-box-bg">
                <div class="me-4"><a href="#">About</a></div>
                <div class="me-4"><a href="#">Contact</a></div>
                <div class="me-4"><a href="#">Team</a></div>
                <form class="ms-4">
                    <div class="input-group input-group-sm search">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                            aria-describedby="button-addon2">
                        <button class="btn btn-secondary" type="button" id="button-addon2"><i
                                class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <form class="header-box header-search-sm" id="search-sm">
                <div class="input-group input-group-sm search-sm">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                        aria-describedby="button-addon2">
                    <button class="btn btn-secondary" type="button" id="button-addon2"><i
                            class="bi bi-search"></i></button>
                </div>
                <div class="ms-2">
                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="openSearch()"><i
                            class="bi bi-x-lg"></i></button>
                </div>
            </form>
            <div class="header-box header-box-sm">
                {{-- Icon About --}}
                <div class="me-3">
                    <button class="btn btn-sm btn-secondary" type="button"><i class="bi bi-tag-fill"></i></button>
                </div>
                {{-- Icon Contact --}}
                <div class="me-3">
                    <button class="btn btn-sm btn-secondary" type="button"><i
                            class="bi bi-telephone-outbound-fill"></i></button>
                </div>
                {{-- Icon Team --}}
                <div class="me-4">
                    <button class="btn btn-sm btn-secondary" type="button"><i class="bi bi-people-fill"></i></button>
                </div>
                {{-- Icon Search --}}
                <div class="me-4">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="openSearch()"><i
                            class="bi bi-search"></i></button>
                </div>
                <!-- Colapse Menu -->
                <div class="close-toggler" onclick="myFunction(this)" id="close-toggle">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        {{-- logo --}}
        <div class="logo"><img id="logo" src="{{ $url }}//template/oraclesoundlab_logo.gif"></div>
        {{-- Menu Area --}}
        <div class="menu-area">
            <ul class="menu">
                @foreach ($pages as $page)
                    @php
                        if ($active === strtolower($page->link)) {
                            $cl = 'active';
                        } else {
                            $cl = '';
                        }
                    @endphp
                    @if (collect($subpages)->flatten()->where('parent_id', $page->id)->last())
                        <li class="has-sub {{ $cl }}">
                            <a href="javascript:;">
                                @if (isset($page->icon))
                                    <i class="{{ $page->icon }}"></i>
                                @endif {{ $page->link }}<div class="float-end"><i
                                        class="bi bi-caret-down-fill" style="font-size: 0.7em"></i></div>
                            </a>
                            <ul class="submenu">
                                @foreach ($subpages as $subpage)
                                    <li><a href="{{ $url }}/{{ Str::lower($subpage->link) }}"><i
                                                class="bi bi-dash"></i>{{ $subpage->link }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class={{ $cl }}><a href="{{ $url }}/{{ Str::lower($page->link) }}">
                                @if (isset($page->icon))
                                    <i class="{{ $page->icon }}"></i>
                                @endif
                                {{ $page->link }}
                            </a>
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
        $(document).ready(function() {
            $('.sidebar li.has-sub a').click(function() {
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
