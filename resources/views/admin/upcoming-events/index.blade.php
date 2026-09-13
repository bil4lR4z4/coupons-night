<!-- resources/views/admin/upcoming-events/index.blade.php -->

@extends('admin.master')

@section('title', 'Upcoming Events')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
          <h2 class=" mb-1">
                All Upcoming Events
            </h2>
        </div>
      <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        All Upcoming Events
                    </li>

                </ol>

            </nav>
        <!-- <a href="{{ route('admin.upcoming-events.create') }}"
           class="btn btn-dark px-4">

            + Add Event

        </a> -->

    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table id="eventTable"
                       class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Button Text</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th width="170">
                            Manage
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($events as $event)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            @if($event->image)

                            <img src="{{ asset('uploads/events/'.$event->image) }}"
                                 width="80"
                                 class="rounded border">

                            @else

                            <img src="https://via.placeholder.com/80x50"
                                 class="rounded border">

                            @endif

                        </td>

                        <td>

                            <div class="fw-bold">

                                {{ $event->title }}

                            </div>

                            <small class="text-muted">

                                {{ $event->subtitle }}

                            </small>

                        </td>

                        <td>

                            {{ $event->button_text }}

                        </td>

                        <td>

                            <div>

                                {{ $event->start_date }}

                            </div>

                            <small class="text-muted">

                                to {{ $event->end_date }}

                            </small>

                        </td>

                        <td>

                            @if($event->status == 1)

                                <span class="badge bg-success">

                                    Enable

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Disable

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.upcoming-events.edit',$event->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.upcoming-events.delete',$event->id) }}"
                                  method="POST"
                                  class="d-inline-block">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

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

        $('#eventTable').DataTable({
            responsive: true,
            pageLength: 10
        });

    });

</script>
@endpush