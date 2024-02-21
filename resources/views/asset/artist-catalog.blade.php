<div class="mb-4 row align-items-center">
    <div class="col">
        <h1>{{ $title }}</h1>
    </div>
    @if ($active === 'index' || $active === 'home')
        <div class="col text-end add-menu"><a href="{{ url('/artists') }}">View more <i
                    class="bi bi-caret-right-fill"></i></a>
        </div>
    @endif
</div>
@if (!empty(@$artists))
    @if ($active != 'index' && $active != 'home' && $active != 'search')
        <div class="mb-3">{{ $artists->links('pagination::webkhu') }}</div>
    @endif
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-6">
        @foreach ($artists as $artist)
            <div class="col-xl-2" onClick="location.href='{{ url('/artists/' . $artist->slug) }}'">
                <div class="simple-border">
                    <div class="simple-galbox">
                        <div class="bg-img-wrapper">
                            <div style="background-image:url({{ url(env('API_LINK') . '/img-artist/web/' . $artist->image) }})"
                                class="bg-img"></div>
                        </div>
                        <div class="img-setup">
                            <div class="bold text-glow">{{ $artist->name }}</div>
                            <div class="text-sm"><i>{{ $artist->title }}</i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
