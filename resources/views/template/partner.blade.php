@if(@$partners !="")
<div class="partners-area mt-4">
<div id="partner" class="carousel slide col-12" data-bs-ride="carousel">
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        @foreach ($partners as $key => $Image)
            @php
                if ($key == 0) {
                    $act = 'active';
                } else {
                    $act = '';
                }
            @endphp
            <a href="{{ $Image->link }}">
                <div class="carousel-item partner-item {{ $act }}">
            <img src="{{ env('API_LINK') }}/partner/{{ $Image->image }}"></a>            
    </div>
    @endforeach
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#partner').carousel({
            interval: 3000, // Waktu perpindahan gambar (ms)
            pause: true // Jika true, slideshow akan berhenti saat cursor berada di atasnya
        });
    });
</script>
</div>
</div>
@endif
