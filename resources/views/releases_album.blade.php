@extends('template.' . $template)

@section('content')
    @if ($albumDetail === '')
        No data Founded
    @else
        <h1 class="text-start">{{ $albumDetail->name }}</h1>
        <h2 class="text-start mb-5">{{ $albumDetail->artists[0]->name }} ({{ $albumDetail->release_date }})</h2>
        <div class="row">
            <div class="col artist-img album-img">
                <img src="{{ $albumDetail->images[0]->url }}" alt="{{ $albumDetail->name }}" width="100%" class="mb-3">
            </div>
            <div class="col">
                <table class="w-100">
                    <thead>
                        <tr style="height: 50px">
                            <th class="col pe-3 text-center">#</th>
                            <th class="col-10 pe-2">Title</th>
                            <th class="col pe-2 text-center"><i class="bi bi-clock" aria-label="duration"></i></th>
                            <th class="col pe-2 text-center">Demo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($albumDetail->tracks->items as $track)
                            <tr>
                                <td class="text-center pe-3" height="45">{{ $loop->iteration }}.</td>
                                <td class="pe-2">{{ $track->name }}</td>
                                <td class="text-center pe-2">
                                    @php
                                        $input = $track->duration_ms;

                                        $seconds = $input % 60;
                                        $input = floor($input / 60);

                                        $minutes = $input % 60;
                                        $input = floor($input / 60);

                                    @endphp
                                    {{ sprintf('%02d:%02d', $minutes, $seconds) }}
                                </td>
                                <td class="text-center pe-2 fs-5">
                                    <div id="{{ 'button' . $loop->iteration }}" onclick="audioPlay({{ $loop->iteration }})"
                                        style="cursor: pointer"><i class="bi bi-play-circle-fill"></i></div>
                                    <audio id="{{ $loop->iteration }}" src="{{ $track->preview_url }}"
                                        type="audio/mp3"></audio>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="d-flex mt-4 justify-content-between">
            <button class="btn btn-off btn-carousel" type="submit" style="border-radius: 5px;"
                onclick="window.history.back()">Back to {{ $active }}</button>
            <button class="btn btn-on btn-carousel" type="submit" style="border-radius: 5px;"
                onclick="window.open('{{ $albumDetail->external_urls->spotify }}', '_blank')">Listen at
                Spotify</button>
        </div>
    @endif
    <script>
        var currentAudio = null;
        var currentPlayBtn = null;

        function audioPlay(id) {
            var audio = document.getElementById(id);
            var PlayBtn = document.getElementById("button" + id);
            if (audio.paused) {
                if (currentAudio !== null && currentAudio !== audio) {
                    currentAudio.pause();
                    currentAudio.currentTime = 0;
                    document.getElementById(currentPlayBtn).innerHTML = "<i class='bi bi-play-circle-fill'>";
                }
                audio.play();
                currentAudio = audio;
                currentPlayBtn = "button" + id;
                PlayBtn.innerHTML = "<i class='bi bi-pause-circle-fill text-color'>";
            } else {
                audio.pause();
                audio.currentTime = 0;
                currentAudio = null;
                currentPlayBtn = null;
                PlayBtn.innerHTML = "<i class='bi bi-play-circle-fill'>";
            }
        };
    </script>
@endsection
