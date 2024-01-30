@if ($artists === '')
    No data Founded
@else
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
    <div class="row g-4 g-4 cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-6">
        @foreach ($artists as $artist)
            <div id="imgcontainer" class="col-xl-2" onClick="location.href='{{ url('/artists/' . $artist->slug) }}'">
                <div class="imgborder">
                    <div class="imggalbox text-glow">
                        <div class="bg-img-wrapper mb-4">
                            <div style="background-image:url({{ url(env('API_LINK') . '/artists/admin/' . $artist->image) }})"
                                class="bg-img"></div>
                        </div>
                        <div class="img-setup">
                            <div>{{ $artist->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
