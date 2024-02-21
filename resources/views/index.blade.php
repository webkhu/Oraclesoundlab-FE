@extends('template.' . $template)

@section('content')
    <div class="row">
        {{-- Carousel  --}}
        @if (!empty(@$carousel))
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
                            style="background: url({{ env('API_LINK') }}/img-carousel/{{ $Image->image }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                            <div class="carousel-caption">
                                <h1>{{ $Image->title }}</h1>
                                <div>{{ $Image->short_desc }}</div>
                                @if ($Image->link)
                                    <div class="mt-4"><button type="button" class="btn btn-on btn-carousel"
                                            onclick="location.href='{{ $Image->link }}'">{{ $Image->link_title }}</button>
                                    </div>
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
                {{-- <script type="text/javascript">
                    $(document).ready(function() {
                        $('.carousel').carousel({
                            interval: 10000, // Waktu perpindahan gambar (ms)
                            pause: true // Jika true, slideshow akan berhenti saat cursor berada di atasnya
                        });
                    });
                </script> --}}
            </div>
        @endif
        {{-- Release --}}
        @if (!empty(@$releases))
            <div class="col-12 mt-5 mb-3">
                @include('asset.releases-catalog', [
                    'title' => $page_title->get('releases'),
                ])
            </div>
        @endif
        {{-- Artists --}}
        @if (!empty(@$artists))
            <div class="col-12 mt-5 mb-3">
                @include('asset.artist-catalog', [
                    'title' => $page_title->get('artists'),
                ])
            </div>
        @endif
        {{-- Event --}}
        @if (!empty(@$events))
            <div class="col-12 mt-5 mb-3">
                @include('asset.events-catalog', [
                    'title' => $page_title->get('events'),
                ])
            </div>
        @endif
        {{-- Article --}}
        @if (!empty(@$article))
            <div class="col-12 mt-5 mb-3">
                @include('asset.article-catalog', [
                    'title' => $page_title->get('article'),
                ])
            </div>
        @endif
        {{-- Streaming --}}
        @if (!empty(@$streaming))
            <div class="col-12 mt-5">
                @include('asset.streaming-catalog', [
                    'datas' => $streaming,
                    'title' => $page_title->get('streaming'),
                    'get_page' => 'streaming',
                ])
            </div>
        @endif
    </div>
@endsection
