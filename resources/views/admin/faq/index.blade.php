@extends('admin.master')

@section('title', 'FAQs')

@section('content')
<div class="container-fluid py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">FAQs</h4>

        @if($sections->count() == 0)
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">
                Add FAQs
            </a>
        @else
            <a href="{{ route('admin.faq.editAll') }}" class="btn btn-warning">
                Update FAQs
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th width="120">Sort Order</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sections as $key => $section)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($section->description), 120) }}</td>
                            <td>{{ $section->sort_order }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No FAQs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection