@if ($teams === '')
    No data Founded
@else
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
    <div class="row cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-4">
        @foreach ($teams as $team)
            <div id="imgcontainer" class="col-xl-2"
                onClick="popup('{{ url(env('API_LINK') . '/teams/web/' . $team->image) }}','<strong>{{ $team->name }}</strong><br>{{ $team->title }}');">
                <div class="imgborder">
                    <div class="imggalbox">
                        <div class="bg-img-wrapper mb-4">
                            <div style="background-image:url({{ url(env('API_LINK') . '/teams/admin/' . $team->image) }})"
                                class="bg-img">
                            </div>
                        </div>
                        <div class="bold text-glow">{{ $team->name }}</div>
                        <div class="mb-2 "><i>{{ $team->title }}</i></div>
                        <div>{{ $team->short_desc }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        @include('asset.modalPopup')
    </div>
@endif
