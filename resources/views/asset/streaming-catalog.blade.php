@php
    if (is_array($datas)) {
        $datas = $datas[0];
    }
@endphp

@if ($active != 'index' && $active != 'home')
    @if (@$setToPlay)
        <div style="width: 90%; margin: auto;">
            <div class="setPlay">{!! $setToPlay->player->embedHtml !!}</div>
            <div class="playerArea mt-3 mb-5 img-setup text-center">{{ $setToPlay->snippet->title }}</div>
        </div>
    @endif
@endif
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
@if (!empty(@$datas))
    @if ($active != 'index' && $active != 'home')
        @php
            $get_page = $active;
        @endphp
        <div class="mb-3">{{ $datas->links('pagination::youtube') }}</div>
    @endif

    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-8">
        @foreach ($datas as $data)
            @php
                if (request()->get('page')) {
                    $setURL = url('/' . $get_page) . '?page=' . request()->get('page') . '&setPage=' . request()->get('setPage') . '&';
                } else {
                    $setURL = url('/' . $get_page) . '?';
                }
            @endphp
            <div id="img-simple" class="col-xl-3"
                onClick="location.href='{{ $setURL . 'id=' . $data->snippet->resourceId->videoId }}'">
                <div class="simple-border">
                    <div class="simple-galbox text-glow">
                        <div class="bg-img-wrapper">
                            <div style="background-image:url({{ $data->snippet->thumbnails->high->url }});"
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
