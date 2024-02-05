@extends('template.' . $template)

@section('content')
    <div class="row gy-5">
        {{-- Carousel  --}}
        <div id="carousel" class="carousel slide col-12" data-bs-ride="carousel">

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                @foreach ($carousel as $key => $Image)
                    @php
                        if ($key == 0) {
                            $act = 'active';
                        } else {
                            $act = '';
                        }
                    @endphp

                    <div class="carousel-item {{ $act }}"
                        style="background: url({{ env('API_LINK') }}/carousel/{{ $Image->image }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                        <div class="carousel-caption">
                            <h1>{{ $Image->title }}</h1>
                            <div>{{ $Image->short_desc }}</div>
                            @if ($Image->link)
                                <div class="mt-4"><button type="button"
                                        class="btn btn-on btn-carousel" onclick="location.href='{{ $Image->link }}'">{{ $Image->link_title }}</button></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                @foreach ($carousel as $key => $Image)
                    @php
                        if ($key == 0) {
                            $act = 'active';
                        } else {
                            $act = '';
                        }
                    @endphp
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to={{ $key }}
                        class={{ $act }}></button>
                @endforeach
            </div>
            <!-- Left and right controls/icons -->
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <i class="bi bi-chevron-right"></i>
        </button> --}}
        </div>
        @if (@collect($artists)->isNotEmpty())
            <div class="col-12">
                @include('asset.artist-catalog', [
                    'title' => $page_title->get('artists'),
                ])
            </div>
        @endif
        @if (@collect($streaming)->isNotEmpty())
            <div class="col-12">
                @include('asset.streaming-catalog', [
                    'datas' => $streaming,
                    'title' => $page_title->get('streaming'),
                    'get_page' => 'streaming',
                ])
            </div>
        @endif
    </div>
@endsection
