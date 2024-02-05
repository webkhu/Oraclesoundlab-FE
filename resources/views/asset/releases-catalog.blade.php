@if ($releases === null)
    No data Founded
@else
    <div class="mb-4 row align-items-center">
        <div class="col">
            <h1>{{ $title }}</h1>
        </div>
        @if ($active === 'index' || $active === 'home')
            <div class="col text-end add-menu"><a href="{{ url('/releases') }}">View more <i
                        class="bi bi-caret-right-fill"></i></a>
            </div>
        @endif
    </div>
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xxl-4">
        @foreach ($releases as $release)
            <div id="imgcontainer" class="col"
                onClick="location.href='{{ url('/releases/' . base64_encode($release->id)) }}'">
                <div class="imgborder">
                    <div class="imggalbox">
                        <div class="bg-img-wrapper mb-4">
                            <div style="background-image:url({{ $release->images[1]->url }});" class="bg-img">
                            </div>
                        </div>
                        <div class="bold text-glow">{{ $release->name }}</div>
                        <div><i>{{ $release->artists[0]->name }}</i></div>
                        {{-- <div class="text-justify">{{ $release->short_desc }}</div> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif