@if (@$partners != '')
    <div class="partners-area">        
        <div class="owl-carousel partners">
            @foreach ($partners as $key => $Image)
                <div class="item partner-item"><img src="{{ env('API_LINK') }}/img-partner/{{ $Image->image }}"
                        onClick="openBlank('{{ $Image->link }}')"></div>
            @endforeach
        </div>
    </div>
@endif
