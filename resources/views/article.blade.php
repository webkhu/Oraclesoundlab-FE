@extends('template.' . $template)

@section('content')
    @if ($datas === '')
        No data Founded
    @else
        <div style="width: 90%; margin: auto;">
            <img class="mb-5" src="{{ url(env('API_LINK') . '/article/admin/' . $datas->image) }}" alt="{{ $datas->title }}"
                width="100%">
            <div class="mb-4">
                <h1 class="text-start">{{ $datas->title }}</h1>
            </div>
            <div class="artist-desc mb-5">{!! $datas->content !!}</div>
            <h3 class="mb-4">Photo Gallery</h3>
            <div class="row cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4">
                @if ($items !== '')
                    @foreach ($items as $item)
                        <div id="imgcontainer" class="col-lg-3 mb-4">
                            <div class="imgborder">
                                <div class="imggalbox">
                                    <div class="bg-img-wrapper mb-4">
                                        <div style="background-image:url({{ url(env('API_LINK') . '/article/gallery/' . $item->image) }})"
                                            class="bg-img"
                                            onClick="popup('{{ url(env('API_LINK') . '/article/gallery/' . $item->image) }}','{{ $item->title }}');">
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
                @endif
            </div>
            <div class="d-flex mt-4 justify-content-start">
                <button class="btn btn-off btn-carousel" type="submit" style="border-radius: 5px;"
                    onclick="window.history.back()">Back to {{ $active }}</button>
            </div>
        </div>
    @endif
@endsection
