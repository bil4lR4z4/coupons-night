@extends('admin.master')

@section('title', 'Slider Images')

@section('content')
<div class="container-fluid">


    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Offer Images on Home page</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.slider-images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="slider">Slider Image</option>
                            <option value="banner">Banner Image</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Page Url</label>
                        <input type="text" name="page_url" class="form-control" placeholder="Enter page url">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>
<div class="col-md-3">
    <label class="form-label">Button Text</label>
    <input type="text" name="button_text" class="form-control"
        placeholder="Enter button text">
</div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Upload Images</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="multiImageInput">
                        <small class="text-muted">You can select multiple Images</small>
                    </div>

                    <div class="col-md-12">
                        <div class="row" id="imagePreviewContainer"></div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning">Upload Images</button>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <h5 class="mb-3">Slider Images</h5>
            <div class="row " id="sortable-slider">
                @forelse($sliders as $item)
                    <div class="col-md-3 mb-4 sortable-item"  data-id="{{ $item->id }}">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('public/uploads/slider-images/' . $item->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                            <div class="card-body">
                                <h6 class="mb-1">{{ $item->title }}</h6>
                                <p class="small mb-1">{{ $item->page_url }}</p>
                                <span class="badge {{ $item->status == 'enable' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('admin.slider-images.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('admin.slider-images.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border">No slider images found.</div>
                    </div>
                @endforelse
            </div>

            <h5 class="mb-3 mt-4">Banner Images</h5>
            <div class="row">
                @forelse($banners as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('public/uploads/slider-images/' . $item->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                            <div class="card-body">
                                <h6 class="mb-1">{{ $item->title }}</h6>
                                <p class="small mb-1">{{ $item->page_url }}</p>
                                <span class="badge {{ $item->status == 'enable' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('admin.slider-images.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('admin.slider-images.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border">No banner images found.</div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.getElementById('multiImageInput').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('imagePreviewContainer');
    previewContainer.innerHTML = '';

    const files = event.target.files;

    if (files.length > 0) {
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-2 mb-3';

                    col.innerHTML = `
                        <div class="card shadow-sm">
                            <img src="${e.target.result}" class="card-img-top" style="height:140px; object-fit:cover;">
                            <div class="card-body p-2">
                                <small class="text-muted d-block text-truncate">${file.name}</small>
                            </div>
                        </div>
                    `;

                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
<script>

new Sortable(document.getElementById('sortable-slider'), {

    animation: 150,

    onEnd: function () {

        let order = [];

        document.querySelectorAll('#sortable-slider .sortable-item')
            .forEach(function (item) {

                order.push(item.dataset.id);

            });

        fetch("{{ route('admin.slider-images.update-order') }}", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },

            body: JSON.stringify({
                order: order
            })

        });

    }

});

</script>
@endpush