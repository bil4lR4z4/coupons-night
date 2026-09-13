@extends('admin.master')

@section('title', 'Add General FAQ')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        parent-label="FAQs"
        parent-route="{{ route('admin.general-faqs.index') }}"
        current-page-title="Add FAQ"
    />
    <div class="card shadow-sm">

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

            <form action="{{ route('admin.general-faqs.store') }}" method="POST">
                @csrf
                     <small class="text-muted d-block mb-3">
    <strong>Note:</strong> Use <code>{store_name}</code> in FAQ questions or answers to display the store name dynamically on the frontend.
    Example: "Does {store_name} offer free shipping?"
</small>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Question</label>
                        <input type="text" name="question" class="form-control" value="{{ old('question') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Answer</label>
                        <textarea name="answer" class="form-control editor">{{ old('answer') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-warning">Add FAQ</button>
                    <a href="{{ route('admin.general-faqs.index') }}" class="btn btn-secondary">View FAQs</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection