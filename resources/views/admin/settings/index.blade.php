@extends('admin.master')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        current-page-title="Settings"
    />
    <div class="card shadow-sm">

        <div class="card-body">
            <x-form method="post" action="{{ route('admin.setting.store') }}">
                <div class="row row-cols-1">

                    <x-input
                        type="file"
                        name="site_logo"
                        label="Site Logo"
                        wrapperClass="col-12"
                    />
                    @if(!empty($edit->site_logo))
                        <div>
                            
                            <img src="{{asset($edit->site_logo)}}" alt="" class="img-thumbnail"  style="width:200px">
                            
                        </div>
                    @endif

                    <x-input
                        type="file"
                        name="footer_logo"
                        label="Footer Logo"
                        wrapperClass="col-12"
                    />
                    @if(!empty($edit->footer_logo))
                        <div>
                            <img src="{{asset($edit->footer_logo)}}" alt="" class="img-thumbnail"  style="width:200px">
                            
                        </div>
                    @endif

                    <x-input
                        type="file"
                        name="favicone"
                        label="Favicone"
                        wrapperClass="col-12"
                    />
                    @if(!empty($edit->favicone))
                        <div>
                            <img src="{{asset($edit->favicone)}}" alt="" class="img-thumbnail" style="width:50px">
                        </div>
                    @endif

                    <div class="mb-3 col-12">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control" name="site_description" id="site_description" rows="3">{{ old('site_description', $edit->site_description ?? '')}}</textarea>
                    </div>

                    <div class="row row-cols-2">
                        <x-input
                            type="url"
                            name="fb_link"
                            value="{{ $edit->fb_link ?? ''}}"
                            placeholder="https://www.facebook.com/"
                            label="Facebook Link"
                            wrapperClass="col-6"
                        />

                        <x-input
                            type="url"
                            name="insta_link"
                            value="{{ $edit->insta_link ?? ''}}"
                            placeholder="https://www.instagram.com/"
                            label="Instagram Link"
                        />

                        <x-input
                            type="url"
                            name="pinterest_link"
                            value="{{ $edit->pinterest_link ?? ''}}"
                            placeholder="https://www.pinterest.com/"
                            label="Pinterest Link"
                        />
                        <x-input
                            type="url"
                            name="youtube_link"
                            value="{{ $edit->youtube_link ?? ''}}"
                            placeholder="https://www.youtube.com/"
                            label="Youtube Link"
                        />

                        <x-input
                            type="url"
                            name="x_link"
                            value="{{ $edit->x_link ?? ''}}"
                            placeholder="https://www.x.com/"
                            label="X Link"
                        />

                        <x-input
                            type="email"
                            name="admin_email"
                            label="Admin Email"
                            value="{{ $edit->admin_email ?? ''}}"
                            wrapperClass="col-12"
                        />

                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save Settings</button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush