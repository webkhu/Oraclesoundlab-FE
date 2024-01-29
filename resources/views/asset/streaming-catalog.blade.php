@if ($datas === '')
    No data Founded
@else
    <div class="mb-4 row align-items-center">
        <div class="col">
            <h1>{{ $title }}</h1>
        </div>
        @if ($active === 'index' || $active === 'home')
            <div class="col text-end add-menu"><a href="{{ url('/streaming') }}">View more <i
                        class="bi bi-caret-right-fill"></i></a>
            </div>
        @endif
    </div>
    @if (($active != 'index' || $active != 'home') && @$setToPlay)
        <div class="setPlay">{!! $setToPlay->player->embedHtml !!}</div>
        <div class="playerArea mt-3 mb-5 img-setup text-center">{{ $setToPlay->snippet->title }}</div>
    @endif
    <div class="mb-3">{{ $datas->links('pagination::youtube') }}</div>
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-8">
        @foreach ($datas as $data)
            @php
                if (request()->get('page')) {
                    $setURL = request()->Url() . '?page=' . request()->get('page') . '&setPage=' . request()->get('setPage') . '&';
                } else {
                    $setURL = request()->Url() . '?';
                }
            @endphp
            <div id="imgcontainer" class="col-xl-3"
                onClick="location.href='{{ $setURL . 'id=' . $data->snippet->resourceId->videoId }}'">
                <div class="imgborder">
                    <div class="imggalbox text-glow">
                        <div class="bg-img-wrapper mb-4">
                            <div style="background-image:url({{ $data->snippet->thumbnails->medium->url }});"
                                class="bg-img">
                            </div>
                        </div>
                        <div class="img-setup">{{ $data->snippet->title }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
