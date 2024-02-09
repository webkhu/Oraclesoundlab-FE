@extends('template.' . $template)

@section('content')
    <h1 class="mb-4">{{ $title }}</h1>
    @if (!empty(@$page))
        <div>
            @php echo $page->content; @endphp
        </div>
    @endif
@endsection
