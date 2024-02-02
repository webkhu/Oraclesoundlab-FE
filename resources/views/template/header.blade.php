<section id="Header">
    <div class="header" role="navigation">
        <div class="header-nav">
            {{-- logo header --}}
            <div class="header-box header-box-sm">
                <img class="header-logo" src="{{ $url }}/template/oraclesoundlab_logo.gif">
            </div>
            <div class="submit">
                {{-- <button class="btn btn-warning bold" id="music-submit" onclick="location.href='{{ $url }}/submission'">Send Demo<i
                        class="bi bi-music-note-beamed ms-2"></i><i class="bi bi-caret-right-fill ms-4"></i></button> --}}
            </div>

            <div class="header-box header-box-bg">
                {{-- Text Menu --}}
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

                {{-- Search Bar --}}
                <form class="ms-4">
                    <div class="input-group input-group-sm search">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                            aria-describedby="button-addon2">
                        <button class="btn btn-on" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <form class="header-box header-search-sm" id="search-sm">
                <div class="input-group input-group-sm search-sm">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                        aria-describedby="button-addon2">
                    <button class="btn btn-on" type="button"><i class="bi bi-search"></i></button>
                </div>
                <div class="ms-2">
                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="openSearch()"><i
                            class="bi bi-x-lg"></i></button>
                </div>
            </form>
            {{-- Menu icon --}}
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
                        <button class="btn btn-sm btn-on {{ $cl }}" type="button"
                            onclick="location.href='{{ $url }}/{{ Str::lower($page->name) }}'"><i
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
