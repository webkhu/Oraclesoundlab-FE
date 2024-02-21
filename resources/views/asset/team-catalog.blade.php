<div class="mb-4 row align-items-center">
    <div class="col">
        <h1>{{ $title }}</h1>
    </div>
    @if ($active === 'index' || $active === 'home')
        <div class="col text-end add-menu"><a href="{{ url('/teams') }}">View more <i
                    class="bi bi-caret-right-fill"></i></a>
        </div>
    @endif
</div>
@if (!empty(@$teams))
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xxl-4">
        @foreach ($teams as $team)
            <div class="col">
                <div class="simple-border">
                    <div class="simple-galbox">
                        <div class="bg-team-wrapper">
                            <div style="background-image:url({{ url(env('API_LINK') . '/img-team/web/' . $team->image) }});"
                                class="bg-img">
                            </div>
                        </div>
                        <div class="bold text-glow">{{ $team->name }}</div>
                        <div class="text-sm mb-2"><i>{{ $team->title }}</i></div>
                        <div class="text-justify">{{ $team->short_desc }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        @include('asset.modalPopup')
    </div>
@endif
