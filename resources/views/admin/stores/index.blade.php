@extends('admin.master')

@section('title', 'View Stores')

@section('content')
<div class="container-fluid">
        <x-breadcrumb current-page-title="All Stores" />
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">View All Stores</h4>
            <a href="{{ route('admin.stores.create') }}" class="btn btn-light btn-sm">Add Store</a>
        </div> -->

        <div class="card-body">

            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="text" id="storeNameFilter" class="form-control" placeholder="Search Store...">
                </div>

                <div class="col-md-2">
                    <select id="networkFilter" class="form-select select2">
                        <option value="">All Networks</option>
                        @foreach($networks as $network)
                        <option value="{{ $network->name }}">{{ $network->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="statusFilter" class="form-select select2">
                        <option value="">All Status</option>
                        <option value="Enable">Enable</option>
                        <option value="Disable">Disable</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="userFilter" class="form-select select2">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                        <option value="{{ $user->username }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="categoryFilter" class="form-select select2">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 d-grid">
                    <button type="button" id="clearStoreFilters" class="btn btn-secondary btn-sm">Clear</button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="storesTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Edit</th>
                            <th>#</th>
                            <th>Store Name</th>
                            <th>Store Network</th>
                            <th>Store Url</th>
                            <!-- <th>Replace Store</th> -->
                            <!-- <th>Store HTML</th> -->
                            <th>Categories</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Updated By</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $key => $store)
                        <tr>
                            <td>
                                <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></a>
                            </td>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->network?->name ?? '-' }}</td>
                            <td>{{ $store->store_url ?? '-' }}</td>
                            <!-- <td>{{ $store->replaceStore?->name ?? '-' }}</td> -->
                            <!-- <td>{{ \Illuminate\Support\Str::limit(strip_tags($store->html_code), 50) }}</td> -->
                            <td>
                                @php
                                $categoryNames = [];

                                if ($store->category_id) {
                                foreach (explode(',', $store->category_id) as $catId) {
                                if(isset($allCategories[$catId])) {
                                $categoryNames[] = $allCategories[$catId];
                                }
                                }
                                }
                                @endphp

                                {{ !empty($categoryNames) ? implode(', ', $categoryNames) : '-' }}
                            </td>
                            
                            <td>
                                @if(auth()->user()->role == 'admin')
                                    <form action="{{ route('admin.stores.status', $store->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            <option value="enable" {{ $store->status == 'enable' ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="disable" {{ $store->status == 'disable' ? 'selected' : '' }}>
                                                Disable</option>
                                        </select>
                                    </form>
                                @else
                                   <span class="badge text-capitalize {{ $store->status == 'enable' ? 'text-bg-success' : 'text-bg-danger' }}">
                                        {{ $store->status }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $store->creator->username ?? 'N/A' }}</td>
                            <td>{{ $store->updater->username ?? 'N/A' }}</td>
                            <td>
                                <!-- <a href="{{ route('admin.stores.edit', $store->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a> -->
                                <a href="{{ route('admin.stores.delete', $store->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this store?')">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No stores found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let table = $('#storesTable').DataTable({
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false,
        columnDefs: [
            {
                targets: 5, // Categories column (0 se count hota hai)
                width: "350px"
            }
        ]
    });

    $('#storeNameFilter').on('keyup', function() {
        table.column(2).search(this.value).draw();
    });

    $('#networkFilter').on('change', function() {
        table.column(3).search(this.value).draw();
    });

    $('#statusFilter').on('change', function() {
        table.column(6).search(this.value).draw();
    });

    $('#userFilter').on('change', function() {
        table.column(7).search(this.value).draw();
    });

    $('#categoryFilter').on('change', function() {
        table.column(5).search(this.value).draw();
    });

    $('#clearStoreFilters').on('click', function() {
        $('#storeNameFilter').val('');
        $('#networkFilter').val('');
        $('#statusFilter').val('');
        $('#userFilter').val('');
        $('#categoryFilter').val('');

        table.columns().search('').draw();
    });
});
</script>
@endpush

<style>
    #storesTable th:nth-child(5),
    #storesTable td:nth-child(5) {
        min-width: 350px;
        width: 350px;
        white-space: normal;
    }
</style>