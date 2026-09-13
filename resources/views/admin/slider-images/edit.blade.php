@extends('admin.master')

@section('title', 'Edit Slider Image')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Image</h4>
        </div>

        <div class="card-body">
            <!-- @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->

            <form action="{{ route('admin.slider-images.update', $sliderImage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="slider" {{ $sliderImage->type == 'slider' ? 'selected' : '' }}>Slider Image</option>
                            <option value="banner" {{ $sliderImage->type == 'banner' ? 'selected' : '' }}>Banner Image</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Page Url</label>
                        <input type="text" name="page_url" class="form-control" value="{{ old('page_url', $sliderImage->page_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $sliderImage->title) }}">
                    </div>
<div class="col-md-3">
    <label class="form-label">Button Text</label>
    <input type="text" name="button_text" class="form-control"
        value="{{ old('button_text', $sliderImage->button_text ?? '') }}"
        placeholder="Enter button text">
</div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable" {{ $sliderImage->status == 'enable' ? 'selected' : '' }}>Enable</option>
                            <option value="disable" {{ $sliderImage->status == 'disable' ? 'selected' : '' }}>Disable</option>
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Change Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" id="singleImageInput">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Current Image</label>
                        <img src="{{ asset('public/uploads/slider-images/' . $sliderImage->image) }}" class="img-fluid rounded border" style="height:180px; width:100%; object-fit:cover;">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">New Preview</label>
                        <img id="singlePreview" src="{{ asset('public/uploads/slider-images/' . $sliderImage->image) }}" class="img-fluid rounded border" style="height:180px; width:100%; object-fit:cover;">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Image</button>
                        <a href="{{ route('admin.slider-images.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('singleImageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('singlePreview');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush