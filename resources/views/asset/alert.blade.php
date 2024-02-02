@if (session()->has('success'))
    <div class="alert mt-3 mb-3 text-start bold glow" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn btn-sm px-2-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('error'))
    <div class="alert mt-3 mb-3 text-start bold glow" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn btn-sm px-2-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
