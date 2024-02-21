@extends('template.' . $template)

@section('content')
    @if ($datas === '')
        No data Founded
    @else
        <div class="mb-5">
            <h1>{{ $datas->title }}</h1>
        </div>
        <div class="artist-detail mb-5">
            <div class="artist-img album-img">
                <img src="{{ url(env('API_LINK') . '/img-event/web/' . $datas->image) }}" alt="{{ $datas->title }}"
                    width="100%">
            </div>
            <div id="details" class="artist-desc">
                @if ($status)
            <h2 class="mb-4" style="color:orangered">{{ '# ' . $status }}</h2>
            @endif
                <div class="mb-4">{!! $datas->description !!}</div>
                <div class="mb-2 pt-3"><h4><strong>Perform date</strong></h4></div>
                <div class="mb-4">{{ $date }}</div>
                <h4 class="mb-2"><strong>Event location</strong></h4>
                <div class="mb-4">{{ $datas->location }}</div>
                <h4 class="mb-3"><strong>Location's map</strong></h4>
                <div>{!! $datas->map !!}</div>
            </div>
        </div>

        <div class="d-flex mt-4 justify-content-between">
            <button class="btn btn-off btn-carousel" type="submit" style="border-radius: 5px;"
                onclick="window.history.back()"><i class="bi bi-caret-left-fill text-sm"></i> Back to {{ $active }}
            </button>
            @if(@$datas->ticketing)
            <button class="btn btn-on btn-carousel" type="submit" style="border-radius: 5px;"
                onclick="window.open('{{ $datas->ticketing }}', '_blank')">Ticket Booth <i class="bi bi-caret-right-fill text-sm"></i></button>
            @endif
        </div>
    @endif
{{-- @include('asset.mapPopup') --}}
@include('asset.modalPopup')
@endsection
