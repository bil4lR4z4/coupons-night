@extends('admin.master')

@section('title', 'Help FAQs')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Help FAQs</h4>

        @if($faqs->count() > 0)
            <a href="{{ route('admin.help-faqs.edit') }}" class="btn btn-warning">
                Edit FAQs
            </a>
        @else
            <a href="{{ route('admin.help-faqs.create') }}" class="btn btn-primary">
                Add Help FAQs
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
                        <th width="120">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $key => $faq)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $faq->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($faq->description), 100) }}</td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                @if($faq->status == 'enable')
                                    <span class="badge bg-success">Enable</span>
                                @else
                                    <span class="badge bg-danger">Disable</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No FAQs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection