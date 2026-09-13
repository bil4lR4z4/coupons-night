{{-- resources/views/components/breadcrumb.blade.php --}}

@props([
    'parentLabel' => null,
    'parentRoute' => null,
    'currentPageTitle' => ''
])

<div class="d-flex justify-content-between align-items-center mb-3">
    
    <h1 class="h2 mb-0">
        {{ $currentPageTitle }}
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">

            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>

            @if($parentLabel && $parentRoute)
                <li class="breadcrumb-item">
                    <a href="{{ $parentRoute }}">
                        {{ $parentLabel }}
                    </a>
                </li>
            @endif

            <li class="breadcrumb-item active" aria-current="page">
                {{ $currentPageTitle }}
            </li>

        </ol>
    </nav>

</div>