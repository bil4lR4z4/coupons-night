@extends('admin.master')



@section('title', 'All Users')



@section('content')

<div class="container-fluid">
        <x-breadcrumb current-page-title="All Users" />

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table id="userTable" class="table table-bordered table-striped align-middle w-100">

                    <thead class="table-dark">

                        <tr>

                            <th>Name</th>

                            <th>Username</th>

                            <th>Email</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                               <td>{{$user->first_name}} {{$user->last_name}}</td>

                               <td>{{$user->username}}</td>

                               <td>{{$user->email}}</td>

                               <td>
                                    @if($user->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Blocked</span>
                                    @endif
                                </td>

                               <td>

                                   <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                   <button class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-delete="{{ route('admin.user.delete', $user->id) }}">Delete</button>

                               </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">No users found.</td>

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
    $(document).ready(function () {
        $('#userTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [[0, 'asc']]
        });
    });
</script>

@endpush