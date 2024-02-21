@extends('template.' . $template)

@section('content')
    @if ($datas === '')
        No data Founded
    @else
        <div class="mb-5">
            <h1>{{ $datas->name }}</h1>
            <h2>{{ $datas->title }}</h2>
        </div>
        <div class="artist-detail mb-5">
            <div class="artist-img">
                <img src="{{ url(env('API_LINK') . '/img-artist/web/' . $datas->image) }}" alt="{{ $datas->name }}"
                    width="100%">
            </div>
            <div class="artist-desc">{!! $datas->description !!}</div>
        </div>
        @if (!empty($items))
            <h3 class="mb-3">Photo Gallery</h3>
            <div class="row cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4">
                @foreach ($items as $item)
                    <div id="imgcontainer" class="col-lg-3 mb-4">
                        <div class="imgborder">
                            <div class="imggalbox">
                                <div class="bg-img-wrapper mb-4">
                                    <div style="background-image:url({{ url(env('API_LINK') . '/img-artist/gallery/' . $item->image) }})"
                                        class="bg-img"
                                        onClick="popup('{{ url(env('API_LINK') . '/img-artist/gallery/' . $item->image) }}','{{ $item->title }}');">
                                    </div>
                                </div>
                                <div class="img-setup">
                                    <div>{{ $item->title }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('asset.modalPopup')
        </div>
        @endif
        <div class="d-flex mt-4 justify-content-start">
            <button class="btn btn-off btn-carousel" type="submit" style="border-radius: 5px;"
                onclick="window.history.back()">Back to {{ $active }}</button>
        </div>
    @endif
@endsection
