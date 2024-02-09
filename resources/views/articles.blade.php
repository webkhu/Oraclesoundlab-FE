@extends('template.' . $template)

@section('content')
    <div class="mb-4 row align-items-center">
        <div class="col">
            <h1>{{ $title }}</h1>
        </div>
        @if ($active === 'index' || $active === 'home')
            <div class="col text-end add-menu"><a href="{{ url('/articles') }}">View more <i
                        class="bi bi-caret-right-fill"></i></a>
            </div>
        @endif
    </div>
    @if (!empty(@$articles))
        @if ($active != 'index' && $active != 'home')
            <div class="mb-3">{{ $articles->links('pagination::webkhu') }}</div>
        @endif
        <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-8">
            @foreach ($articles as $article)
                <div id="imgcontainer" class="col-xl-3" onClick="location.href='{{ url('/article/' . $article->slug) }}'">
                    <div class="imgborder">
                        <div class="imggalbox">
                            <div class="bg-img-wrapper mb-4">
                                <div style="background-image:url({{ url(env('API_LINK') . '/article/admin/' . $article->image) }})"
                                    class="bg-img"></div>
                            </div>
                            <div class="img-setup">
                                <div class="bold text-glow mb-2">{{ $article->title }}</div>
                                <div class="text-justify">{{ $article->short_desc }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
