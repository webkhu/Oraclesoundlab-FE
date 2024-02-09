<div class="mb-4 row align-items-center">
    <div class="col">
        <h1>{{ $title }}</h1>
    </div>
    @if (@$active === 'index' || $active === 'home')
        <div class="col text-end add-menu"><a href="{{ url('/article') }}">View more <i
                    class="bi bi-caret-right-fill"></i></a>
        </div>
    @endif
</div>
@if (!empty(@$article))
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3">
        @foreach ($article as $content)
            <div id="imgcontainer" class="col" onClick="location.href='{{ url('/article/' . $content->slug) }}'">
                <div class="article-area">
                    <div class="bold text-glow mb-3">{{ $content->title }}</div>
                    <div class="text-justify">{{ $content->short_desc }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endif
