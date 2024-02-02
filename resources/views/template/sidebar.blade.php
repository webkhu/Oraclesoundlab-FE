<section id="Sidebar">
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
            @php
                if ($active === 'submission') {
                    $cl = 'active';
                } else {
                    $cl = '';
                }
            @endphp
            <div class="menu-gold {{ $cl }} bold mt-5 d-flex justify-content-between" id="music-submit"
                onclick="location.href='{{ $url }}/submission'">
                <div class="col justify-content-start"><i class="bi bi-music-note-beamed"></i>Send Demo</div><i
                    class="col-2 bi bi-caret-right-fill ms-5"></i>
            </div>
        </div>
    </div>
</section>
