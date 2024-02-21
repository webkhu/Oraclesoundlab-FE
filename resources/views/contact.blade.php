@extends('template.' . $template)

@section('content')
    <h1 class="mb-4">{{ $title }}</h1>
    @include('asset.alert')
    <section id="mail-form" class="row">
        <div class="col col-lg-8">
            <div class="set-border">
                <form autocomplete="off" action="{{ url('contact') }}" method="POST" name="submission">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="" required value="{{ old('name') }}" autocomplete="off">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="" required value="{{ old('email') }}" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label bold" for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                            id="subject" placeholder="" required value="{{ old('subject') }}" autocomplete="off">
                        @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label bold" for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" style="height: 150px; resize: none;" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <input type="hidden" value="Sending" name="SendMail">
                        <button class="btn btn-on btn-carousel" type="submit" style="border-radius: 5px;">Send
                            Mail</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-5 set-space">
            <h2 class="mb-3">Direct Contact</h2>
            <div class="mb-2 footer-logo text-color bold">Oracle Sound Lab</div>
            <div class="mb-2">Record Label &amp; Streaming.<br>Bali Indonesia.</div>
            <div class="">
                <i class="bi bi-envelope text-color me-1"></i> <a href="mailto:admin@oraclesoundlab.com">
                    <span id="c-mail"></span></a>
                <script>
                    document.getElementById('c-mail').innerHTML = 'admin' + '@' + 'oraclesoundlab.com';
                </script>
                <br>
                <i class="bi bi-telephone text-color me-1"></i> <a href="tel:+6281338383288">
                    <span id="c-phone"></span></a>
                <script>
                    document.getElementById('c-phone').innerHTML = '+62' + '-' + '813-3838-3288';
                </script>
            </div>
            <h2 class="mb-3 mt-5">Social Media</h2>
            <div class="row fs-4">
                <div class="col icon-area"><a href="https://www.instagram.com/oraclesoundlabdnb/"><i
                            class="bi bi-instagram"></a></i></div>
                <div class="col icon-area"><a href="https://twitter.com/oraclesoundlab"><i class="bi bi-twitter"></i></a>
                </div>
                <div class="col icon-area"><a href="https://www.tiktok.com/@oraclesoundlabdnb"><i
                            class="bi bi-tiktok"></i></a>
                </div>
                <div class="col icon-area"><a href="https://open.spotify.com/playlist/0rrYlaiFGwyNyPA2zXpYV3"><i
                            class="bi bi-spotify"></i></a></div>
                <div class="col icon-area"><a href="https://www.youtube.com/@OracleSoundlab/videos"><i
                            class="bi bi-youtube"></i></a></div>
            </div>
        </div>
    </section>
@endsection
