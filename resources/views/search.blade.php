@extends('template.' . $template)

@section('content')
    <h1>{{ $title }}</h1>
    <div class="row">
        {{-- Artists --}}
        @if (!empty(@$artists))
            <div class="col-12 mt-5 mb-3">
                @include('asset.artist-catalog', [
                    'title' => $page_title->get('artists'),
                ])
            </div>
        @endif
        {{-- Articel --}}
        @if (!empty(@$events))
            <div class="col-12 mt-5 mb-3">
                @include('asset.events-catalog', [
                    'title' => $page_title->get('events'),
                ])
            </div>
        @endif
        {{-- Articel --}}
        @if (!empty(@$articles))
            <div class="col-12 mt-5 mb-3">
                @include('asset.article-catalog', [
                    'title' => $page_title->get('article'),
                ])
            </div>
        @endif
    </div>
@endsection
