@extends('admin.master')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid">
<x-breadcrumb 
    parent-label="Categories"
    :parent-route="route('admin.categories.index')"
    current-page-title="Add Category"
/>
    <div class="card">
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Title</label>
                        <input type="text" name="title" class="form-control @error('title') border-danger @enderror"
                            value="{{ old('title', $category->title) }}">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-select">
                            <option value="">Main Category</option>
                            @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable" {{ old('status', $category->status) == 'enable' ? 'selected' : '' }}>
                                Enable</option>
                            <option value="disable"
                                {{ old('status', $category->status) == 'disable' ? 'selected' : '' }}>Disable</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image (200x200)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="w-100">
                            
                            <label class="form-check-label border w-100 px-2 pt-1 pb-2 rounded-2" for="mark_home">
                               <input class="form-check-input me-2" type="checkbox" name="mark_home" id="mark_home" value="1"
                                {{ old('mark_home', $category->mark_home) ? 'checked' : '' }}>Mark on Home Page
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Type</label>

                        <div class="">
                            
                            <label class="form-check-label border w-100 px-2 pt-1 pb-2 rounded-2" for="is_sensitive">
                               <input class="form-check-input me-2" type="checkbox" name="is_sensitive" value="1"
                                id="is_sensitive" {{ old('is_sensitive', $category->is_sensitive) ? 'checked' : '' }}>Mark as Sensitive / Adult Category
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hidden_user_ids" class="form-label">Hide This Category For Users</label>
                        <select name="hidden_user_ids[]" id="hidden_user_ids" class="form-control select2" multiple>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ in_array($user->id, old('hidden_user_ids', isset($category) ? $category->hidden_user_ids_array : [])) ? 'selected' : '' }}>
                                {{ $user->first_name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>

                        @error('hidden_user_ids')
                        <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        @error('hidden_user_ids.*')
                        <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>

                    @if($category->image)
                    <div class="col-md-12 mb-3">
                        <img src="{{ asset('public/uploads/categories/' . $category->image) }}" width="100" height="100"
                            style="object-fit:cover;">
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-warning">Save Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection