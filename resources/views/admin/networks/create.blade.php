@extends('admin.master')

@section('title', 'Add Network')

@section('content')
<div class="container-fluid">
    <x-breadcrumb 
        parent-label="Networks"
        :parent-route="route('admin.networks.index')"
        current-page-title="Add Network"
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

            <form action="{{ route('admin.networks.store') }}" method="POST">
                @csrf

                <div class="row justify-content-center g-3">
                    <div class="col-md-5">
                        <label class="form-label">Network Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Network Color</label>
                        <input type="color" name="color" class="form-control form-control-color w-100" value="{{ old('color', '#000000') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Network Status</label>
                        <select name="status" class="form-select">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>

                    <div class="col-md-11 text-center mt-3">
                        <button type="submit" class="btn btn-warning px-4">Add Network</button>
                        <a href="{{ route('admin.networks.index') }}" class="btn btn-secondary px-4">View Networks</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection