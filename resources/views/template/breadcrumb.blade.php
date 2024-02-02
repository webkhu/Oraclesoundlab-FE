<section id="Breadcrumb">
    @if ($active !== 'index' && $active !== 'home')
        <div class="mb-5 breadcrumb"><a href="{{ $url }}">Home</a>
            @php
                $x = 10;
                $breadUrl = '';
                for ($n = 1; $n < $x; $n++) {
                    $breadCrumb = 'crumb' . $n;
                    if (isset($$breadCrumb)) {
                        $childUrl = $breadUrl . '/' . Str::lower($$breadCrumb);
                        echo ' <i class="bi bi-chevron-right breadcrumb-arrow"></i> <a href="' . $url . $childUrl . '">' . $$breadCrumb . '</a>';
                        $breadUrl = $childUrl;
                    } else {
                        $x = 0;
                    }
                }
            @endphp
        </div>
    @endif
</section>
