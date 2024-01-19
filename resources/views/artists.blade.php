@extends('template.' . $template)

@section('content')
    @if ($datas === '')
        No data Founded
    @else
        <div class="mb-5">
            <h1>Artists</h1>
        </div>
        <div class="row cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
            @foreach ($datas as $data)
                <div id="imgcontainer" class="col-xl-2 mb-4">
                    <div class="imgborder">
                        <div class="imggalbox">
                            <div class="bg-img-wrapper mb-4">
                                <div style="background-image:url({{ url(env('API_LINK') . '/artists/web/' . $data->image) }})"
                                    class="bg-img"
                                    onClick="location.href='{{ url('/artists/' . $data->slug) }}'"></div>
                            </div>
                            <div class="img-setup">
                                <div>{{ $data->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
