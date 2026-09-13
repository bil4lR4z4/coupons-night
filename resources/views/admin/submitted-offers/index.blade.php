@extends('admin.master')

@section('title', 'Submitted Offers')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Submitted Offers</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">

            <table id="submittedOffersTable" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Store URL</th>
                        <th>Coupon Code</th>
                        <th>Expiry Date</th>
                        <th>Description</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($offers as $key => $offer)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $offer->full_name }}</td>
                            <td>{{ $offer->email }}</td>
                            <td>
                                <a href="{{ $offer->store_url }}" target="_blank">
                                    {{ Str::limit($offer->store_url, 35) }}
                                </a>
                            </td>
                            <td>{{ $offer->coupon_code ?? 'N/A' }}</td>
                            <td>{{ $offer->expiry_date ?? 'N/A' }}</td>
                            <td>{{ Str::limit($offer->description, 60) }}</td>
                            <td>
                                <form action="{{ route('admin.submitted.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this offer?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No submitted offers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#submittedOffersTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            responsive: true
        });
    });
</script>
@endpush