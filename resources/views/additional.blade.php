@extends('template.' . $template)

@section('content')
    @if (empty($page))
        No data Founded
    @else
        <h1 class="mb-4">{{ $title }}</h1>
        <div>
            @php
                if (@$page->content === null) {
                    $content = '';
                } else {
                    $content = $page->content;
                }
                if (@$subpage->content === null) {
                    $subcontent = '';
                } else {
                    $subcontent = $subpage->content;
                }

                if (empty($page)) {
                    echo $subcontent;
                } else {
                    echo $content;
                }
            @endphp
        </div>
    @endif
@endsection
