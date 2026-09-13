@extends('admin.master')

@section('title', 'Edit Event')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        parent-label="Events"
        :parent-route="route('admin.events.index')"
        current-page-title="Update Event"
    />
    <div class="card shadow-sm">

        <div class="card-body">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name', $event->name) }}">
                        @error('name')
                            <span class="text-danger small">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') border-danger @enderror" value="{{ old('title', $event->title) }}">
                        @error('title')
                            <span class="text-danger small">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control @error('meta_description') border-danger @enderror" rows="3">{{ old('meta_description', $event->meta_description) }}</textarea>
                        @error('meta_description')
                            <span class="text-danger small">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Full Description</label>
                        <textarea name="full_description" class="form-control @error('full_description') border-danger @enderror" rows="3">{{ old('full_description', $event->full_description) }}</textarea>
                        @error('full_description')
                            <span class="text-danger small">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable" {{ $event->status == 'enable' ? 'selected' : '' }}>Enable</option>
                            <option value="disable" {{ $event->status == 'disable' ? 'selected' : '' }}>Disable</option>
                        </select>
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <div class="w-100">
                            
                            <label class="form-check-label border w-100 px-2 pt-1 pb-2 rounded-2" for="show_in_header">
                                <input class="form-check-input me-2" type="checkbox" name="show_in_header" id="show_in_header" value="1" {{ $event->show_in_header ? 'checked' : '' }}>Show in Header
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Icon (200x200)</label>
                        <input type="file" name="icon" class="form-control" id="iconInput" accept="image/*">
                        @if($event->icon)
                            <div class="mt-2">
                                <img id="iconPreview" src="{{ asset('public/uploads/events/' . $event->icon) }}" class="img-thumbnail" style="max-width:100px;">
                            </div>
                        @else
                            <div class="mt-2">
                                <img id="iconPreview" class="img-thumbnail" style="max-width:100px; display:none;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Full Image (610x260)</label>
                        <input type="file" name="full_image" class="form-control" id="fullImageInput" accept="image/*">
                        @if($event->full_image)
                            <div class="mt-2">
                                <img id="fullImagePreview" src="{{ asset('public/uploads/events/' . $event->full_image) }}" class="img-thumbnail" style="max-width:120px;">
                            </div>
                        @else
                            <div class="mt-2">
                                <img id="fullImagePreview" class="img-thumbnail" style="max-width:120px; display:none;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Image Square</label>
                        <input type="file" name="image_square" class="form-control" id="squareImageInput" accept="image/*">
                        @if($event->image_square)
                            <div class="mt-2">
                                <img id="squareImagePreview" src="{{ asset('public/uploads/events/' . $event->image_square) }}" class="img-thumbnail" style="max-width:120px;">
                            </div>
                        @else
                            <div class="mt-2">
                                <img id="squareImagePreview" class="img-thumbnail" style="max-width:120px; display:none;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
}

previewImage('iconInput', 'iconPreview');
previewImage('fullImageInput', 'fullImagePreview');
previewImage('squareImageInput', 'squareImagePreview');
</script>
@endpush