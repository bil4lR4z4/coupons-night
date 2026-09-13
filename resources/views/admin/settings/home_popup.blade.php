@extends('admin.master')

@section('title', 'Home Page Popup')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        current-page-title="Home Page Popup"
    />
    <div class="card shadow-sm">

        <div class="card-body">
            <x-form method="post" action="{{ route('admin.home.page.popup') }}">
                <div class="row mb-5">
                    <div class="mb-3 col-12">
                        <label for="offer_description" class="form-label">Offer Description</label>
                        <textarea class="form-control h-100 editor" name="offer_description" id="offer_description" rows="3">{{ old('offer_description', $edit->offer_description ?? '')}}</textarea>
                    </div>
                    <div class="col-12 ">
                        <x-input
                            type="text"
                            name="offer_button"
                            label="Offer Button URL"
                            value="{{$edit->offer_button ?? ''}}"
                        />
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="active" name="offer_checkbox" id="checkDefault" {{ old('offer_checkbox', $edit->offer_checkbox ?? '') == 'active' ? 'checked' : ''}}>
                            <label class="form-check-label" for="checkDefault">
                                Active {{$edit->offer_checkbox ?? ''}}
                            </label>
                        </div>
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