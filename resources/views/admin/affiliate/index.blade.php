@extends('admin.master')

@section('title', 'Affiliate Sections')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Affiliate Sections</h4>

        @if($sections->count() == 0)
            <a href="{{ route('admin.affiliate.create') }}" class="btn btn-primary">
                Add Affiliate Sections
            </a>
        @else
            <a href="{{ route('admin.affiliate.editAll') }}" class="btn btn-warning">
                Update Affiliate Sections
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
                            <td colspan="4" class="text-center">No sections found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection