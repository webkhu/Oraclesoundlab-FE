<div class="mb-4 row align-items-center">
    <div class="col">
        <h1>{{ $title }}</h1>
    </div>
    @if ($active === 'index' || $active === 'home')
        <div class="col text-end add-menu"><a href="{{ url('/events') }}">View more <i
                    class="bi bi-caret-right-fill"></i></a>
        </div>
    @endif
</div>
@if (!empty(@$events))
    @if ($active != 'index' && $active != 'home' && $active != 'search')
        <div class="mb-3">{{ $events->links('pagination::webkhu') }}</div>
    @endif
    <div class="row g-4 cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-8">
        @foreach ($events as $event)
            @php
                [$d, $m, $Y] = explode('/', $event->date);
                if (strtotime($Y . '/' . $m . '/' . $d) > time()) {
                    $status = '';
                } else {
                    $status = 'Past Event';
                }

                [$d, $m, $Y] = explode('/', $event->date);
                $month = date('F', mktime(0, 0, 0, $m, 10));
                $date = $d . ' ' . $month . ' ' . $Y;
            @endphp
            <div id="img-event" class="col-xl-3" onClick="location.href='{{ url('/events/' . $event->slug) }}'">
                <div class="event-border">
                    <div class="event-galbox">
                        <div class="bg-img-wrapper">
                            <div style="background-image:url({{ url(env('API_LINK') . '/img-event/web/' . $event->image) }})"
                                class="bg-img d-flex">
                            </div>
                            @if ($status)
                                <div class="img-status align-self-center">{{ $status }}</div>
                            @endif
                        </div>
                        <div class="img-setup">
                            <div class="bold text-glow">{{ $event->title }}</div>
                            <div class="text-sm"><i>{{ $date }}</i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
