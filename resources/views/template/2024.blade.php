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
    <section id="Header">
        <div class="header" role="navigation">
            <div class="header-nav">
                <div class="header-box header-box-sm">
                    <img class="header-logo" src="{{ $url }}/template/oraclesoundlab_logo.gif">
                </div>
                <!-- Search Bar -->
                <div class="header-box header-box-bg">
                    @foreach (collect($pages)->where('position', 'Header') as $page)
                        @php
                            if ($active === $page->name) {
                                $cl = 'active';
                            } else {
                                $cl = '';
                            }
                        @endphp
                        <div class="me-4 {{ $cl }}">
                            @if ($page->type === 'Add')
                            <a href="{{ $url }}/page/{{ $page->name }}">
                            @else
                            <a href="{{ $url }}/{{ $page->name }}">
                            @endif
                                {{ $page->link }}
                            </a>
                            </div>
                    @endforeach
                    <form class="ms-4">
                        <div class="input-group input-group-sm search">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="button-addon2">
                            <button class="btn btn-on" type="button"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <form class="header-box header-search-sm" id="search-sm">
                    <div class="input-group input-group-sm search-sm">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                            aria-describedby="button-addon2">
                        <button class="btn btn-on" type="button"><i
                                class="bi bi-search"></i></button>
                    </div>
                    <div class="ms-2">
                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="openSearch()"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                </form>
                <div class="header-box header-box-sm">
                    @foreach (collect($pages)->where('position', 'Header') as $page)
                        @php
                            if ($active === $page->name) {
                                $cl = 'active';
                            } else {
                                $cl = '';
                            }
                        @endphp
                        <div class="me-2">
                            <button class="btn btn-sm btn-on {{ $cl }}" type="button"><i
                                    class="{{ $page->icon }}"></i></button>
                        </div>
                    @endforeach
                    {{-- Icon Search --}}
                    <div class="me-3">
                        <button class="btn btn-sm btn-on" type="button" onclick="openSearch()"><i
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
    </section>
    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        {{-- logo --}}
        <div class="logo"><img id="logo" src="{{ $url }}/template/oraclesoundlab_logo.gif"></div>
        {{-- Menu Area --}}
        <div class="menu-area">
            <ul class="menu">
                @foreach (collect($pages)->where('position', 'Sidebar') as $page)
                    @php
                        if ($active === $page->name) {
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
                                    <li><a href="{{ $url }}/{{ Str::lower($subpage->name) }}"><i
                                                class="bi bi-dash"></i>{{ $subpage->link }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class={{ $cl }}>
                            @if ($page->type === 'Add')
                                <a href="{{ $url }}/page/{{ Str::lower($page->name) }}">
                            @else
                                <a href="{{ $url }}/{{ Str::lower($page->name) }}">
                            @endif
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
    <div class="right-area">
        <div class="content">
            {{-- Breadcrumb --}}
            @if ($active !== 'index' && $active !== 'home')
                <div class="mb-5 breadcrumb"><a href="{{ $url }}">Home</a>
                    @php
                        $x = 10;
                        $breadUrl = '';
                        for ($n = 1; $n < $x; $n++) {
                            $breadCrumb = 'crumb' . $n;
                            if (isset($$breadCrumb)) {
                                $childUrl = $breadUrl . '/' . Str::lower($$breadCrumb);
                                echo ' <i class="bi bi-chevron-right breadcrumb-arrow"></i> <a href="' . $url . $childUrl . '">' . $$breadCrumb . '</a>';
                                $breadUrl = $childUrl;
                            } else {
                                $x = 0;
                            }
                        }
                    @endphp
                </div>
            @endif
            {{-- Page Content --}}
            @yield('content')
        </div>
        {{-- Footer Area  --}}
        <div class="footer-area">
            <div class="row justify-content-between ">
                <div class="col-12 col-md-6 col-xxl-4 foot-order2">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col">
                                <div class="bold mb-2">{{ $category->name }}</div>
                                @foreach (collect($pages)->where('category_id', $category->id) as $page)
                                    <div>
                                        <a href="{{ $url }}/{{ Str::lower($page->link) }}">&#x2022;
                                            {{ $page->link }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6 foot-order1">
                    <div class="mb-2 footer-logo text-color bold">Oracle Sound Lab</div>
                    <div class="mb-2">Record Label &amp; Streaming.<br>Bali Indonesia.</div>
                    <div class="">
                        <i class="bi bi-envelope text-color me-1"></i> <a href="mailto:admin@oraclesoundlab.com">
                            <span id="email"></span></a>
                        <script>
                            document.getElementById('email').innerHTML = 'admin' + '@' + 'oraclesoundlab.com';
                        </script>
                        <br>
                        <i class="bi bi-telephone text-color me-1"></i> <a href="tel:+6281338383288">
                            <span id="phone"></span></a>
                        <script>
                            document.getElementById('phone').innerHTML = '+62' + '-' + '813-3838-3288';
                        </script>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-between">
                <div class="socmed foot-order2 col-12 col-md-4 col-lg-4 col-xxl-4">
                    <div class="row">
                        <div class="col"><a href="https://www.instagram.com/oraclesoundlabdnb/"><i
                                    class="bi bi-instagram"></a></i></div>
                        <div class="col"><a href="https://twitter.com/oraclesoundlab"><i
                                    class="bi bi-twitter"></i></a></div>
                        <div class="col"><a href="https://www.tiktok.com/@oraclesoundlabdnb"><i
                                    class="bi bi-tiktok"></i></a></div>
                        <div class="col"><a href="https://open.spotify.com/playlist/0rrYlaiFGwyNyPA2zXpYV3"><i
                                    class="bi bi-spotify"></i></a></div>
                        <div class="col"><a href="https://www.youtube.com/@OracleSoundlab/videos"><i
                                    class="bi bi-youtube"></i></a></div>
                    </div>
                </div>
                <div class="copyright foot-order1 col-12  col-md-6">Copyright © {{ date('Y') }}. Oracle Sound
                    Lab<br>All
                    rights reserved.</div>
            </div>
        </div>
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
