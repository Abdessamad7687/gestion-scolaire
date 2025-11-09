@php
    $toastTypes = [
        'success' => 'bg-success text-white',
        'error' => 'bg-danger text-white',
        'warning' => 'bg-warning text-dark',
        'info' => 'bg-info text-dark',
        'status' => 'bg-primary text-white',
    ];
@endphp

@if (collect($toastTypes)->keys()->contains(fn ($key) => session()->has($key)))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        @foreach ($toastTypes as $key => $classes)
            @if (session()->has($key))
                <div class="toast align-items-center {{ $classes }} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session($key) }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif


