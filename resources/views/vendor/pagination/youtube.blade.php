@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="paginate">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true">
                        <span class="btn btn-on active"><i class=" bi bi-caret-left"></i></span>
                    </li>
                @else
                    <li>
                        <a class="btn btn-on"
                            href="{{ $paginator->previousPageUrl() . '&id=' . $paginator->playId . '&setPage=' . $paginator->prevPageToken }}"
                            rel="prev"><i class=" bi bi-caret-left"></i></a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a class="btn btn-on"
                            href="{{ $paginator->nextPageUrl() . '&id=' . $paginator->playId . '&setPage=' . $paginator->nextPageToken }}"
                            rel="next"><i class=" bi bi-caret-right"></i></a>
                    </li>
                @else
                    <li aria-disabled="true">
                        <span class="btn btn-on active"><i class=" bi bi-caret-right"></i></span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small">
                    <span>{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span>{{ $paginator->lastItem() }}</span>
                    {!! __('from') !!}
                    <span>{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="paginate">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="me-3" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="btn btn-on active" aria-hidden="true"><i
                                    class=" bi bi-caret-left-fill"></i></span>
                        </li>
                    @else
                        <li class="me-3">
                            <a class="btn btn-on"
                                href="{{ $paginator->previousPageUrl() . '&id=' . $paginator->playId . '&setPage=' . $paginator->prevPageToken }}"
                                rel="prev" aria-label="@lang('pagination.previous')"><i
                                    class=" bi bi-caret-left-fill"></i></a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a class="btn btn-on"
                                href="{{ $paginator->nextPageUrl() . '&id=' . $paginator->playId . '&setPage=' . $paginator->nextPageToken }}"
                                rel="next" aria-label="@lang('pagination.next')"><i
                                    class=" bi bi-caret-right-fill"></i></a>
                        </li>
                    @else
                        <li aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="btn btn-on active" aria-hidden="true"><i
                                    class=" bi bi-caret-right-fill"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
