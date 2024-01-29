@extends('template.' . $template)

@section('content')
    <div class="row gy-5">
        {{-- Carousel  --}}
        <div id="carousel" class="carousel slide col-12" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                @php
                    $m = 1;
                    $x = 0;
                @endphp
                @foreach ($carousel as $Image)
                    @php
                        if ($m === 1) {
                            $act = 'active';
                            $m = 0;
                        } else {
                            $act = '';
                        }
                    @endphp
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to={{ $x }}
                        class={{ $act }}></button>
                    @php
                        $x = $x + 1;
                    @endphp
                @endforeach
            </div>
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                @php $n = 1; @endphp
                @foreach ($carousel as $Image)
                    @php
                        if ($n === 1) {
                            $act = 'active';
                            $n = 0;
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
                                        class="btn btn-on btn-carousel">{{ $Image->link_title }}</button></div>
                            @endif
                        </div>
                    </div>
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
                @include('asset.artist-catalog')
            </div>
        @endif
    </div>
@endsection
