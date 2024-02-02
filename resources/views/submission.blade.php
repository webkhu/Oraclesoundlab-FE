@extends('template.' . $template)

@section('content')
    <h1 class="mb-4">{{ $title }}</h1>
    @include('asset.alert')
    <section id="mail-form" class="row">
        <div class="col col-lg-8">
            <div class="set-border gold-border">
                <form autocomplete="off" action="{{ url('submission') }}" method="POST" name="submission">
                    @method('post')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold"
                                for="submission_type @error('submission_type') is-invalid @enderror" id="submission_type"
                                placeholder="submission_type">Submission Type</label>
                            <select name="type" class="form-control" required>
                                <option value="" disabled selected hidden>Please select</option>
                                <option value="Single">Single Album ( 1 - 3 tracks )</option>
                                <option value="EP">EP Album ( 4 - 6 tracks )</option>
                                <option value="LP">LP Album ( 7 - 29 tracks )</option>
                            </select>
                            @error('submission_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="artist_name">Artist Name</label>
                            <input type="text" name="artist_name"
                                class="form-control @error('artist_name') is-invalid @enderror" id="artist_name"
                                placeholder="" required value="{{ old('artist_name') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="main_social_media">Main Social Media</label>
                            <input type="text" name="main_social_media" class="form-control @error('main_social_media') is-invalid @enderror"
                                id="main_social_media" placeholder="Social media link" required value="{{ old('main_social_media') }}">
                            @error('main_social_media')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label bold" for="music_link">Music Link *</label>
                            <input type="text" name="music_link"
                                class="form-control @error('music_link') is-invalid @enderror" id="music_link"
                                placeholder="drive.google.com/your_file" required value="{{ old('music_link') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label bold" for="short_bio">Short Bio <span class="text-sm">(1000 char
                                max)<span></label>
                        <textarea id="short_bio" name="short_bio" class="form-control" style="height: 150px; resize: none;" maxlength="1000"
                            required>{{ old('short_bio') }}</textarea>
                        @error('short_bio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <input type="hidden" value="Sending" name="SendMail">
                        <button class="btn btn-on btn-carousel" type="submit" style="border-radius: 5px;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-5 set-space">
            <h3 class="mb-4">Terms & Conditions</h3>
            <div class="mb-3">We will not accept the following content for distribution:</div>
            <div>
                <ul>
                    <li>Any non-exclusive or Public Domain sound recordings that are already in distribution</li>
                    <li>Soundalike or generic/misleading Tribute releases</li>
                    <li>Karaoke (other than by the original artist)</li>
                    <li>Low budget content with little editorial value</li>
                    <li>Titles packed with keywords</li>
                    <li>Low-quality cover art</li>
                    <li>Radio broadcasts</li>
                    <li>Any content without clear chain of title</li>
                </ul>
            </div>
            <div class="mb-3 mt-4">* All submission required:</div>
            <div>
                <ul>
                    <li>music files</li>
                    <li>artwork</li>
                    <li>biography</li>
                    <li>Full lyric</li>
                    <li>Submit only google drive link</li>                    
                </ul>
            </div>
        </div>
    </section>
@endsection
