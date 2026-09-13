@extends('admin.master')

@section('title', 'Home Page Settings')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        current-page-title="Home Page Settings"
    />
    <div class="card shadow-sm">

        <div class="card-body">
            <x-form method="post" action="{{ route('admin.home.page') }}">
                <div class="row mb-5">
                    <div class="mb-3 col-8">
                        <label for="how_to_use" class="form-label">How To Use Description</label>
                        <textarea class="form-control h-100" name="how_to_use" id="how_to_use" rows="3">{{ old('how_to_use', $edit->how_to_use ?? '')}}</textarea>
                    </div>
                    <div class="col-4">
                        <x-input
                            type="file"
                            name="how_to_use_image"
                            label="How to use video"
                        />
                        @if(!empty($edit->how_to_use_image))
                            <div>
                                <video class="img-thumbnail w-100"  controls>
                                    <source src="{{ asset($edit->how_to_use_image) }}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    </div>
                   
                </div>
                <div class="row">
                    <div class="mb-3 col-8">
                        <label for="why_chose" class="form-label">Why Chose Us Description</label>
                        <textarea class="form-control h-100" name="why_chose" id="why_chose" rows="3">{{ old('why_chose', $edit->why_chose ?? '')}}</textarea>
                    </div>
                    <div class="col-4">
                        <x-input
                            type="file"
                            name="why_chose_us_image"
                            label="Why Chose Us Image (400x400)"
                        />
                        @if(!empty($edit->why_chose_us_image))
                            <div>
                                <img src="{{asset($edit->why_chose_us_image)}}" alt="" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                   
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                
            </x-form>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush