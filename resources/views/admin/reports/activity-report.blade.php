@extends('admin.master')

@section('title', 'Employee Activity Report')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Employee Activity Report</h4>
        </div>

        <div class="card-body">

            <form method="GET" action="{{ url('admin/activity-report') }}">
                <div class="row">

                    <div class="col-md-3">
                        <label>From Date</label>
                        <input type="date"
                               name="from_date"
                               class="form-control"
                               value="{{ request('from_date') }}">
                    </div>

                    <div class="col-md-3">
                        <label>To Date</label>
                        <input type="date"
                               name="to_date"
                               class="form-control"
                               value="{{ request('to_date') }}">
                    </div>

                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary w-100 d-block">
                            Filter
                        </button>
                    </div>

                </div>
            </form>

            <hr>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>
                            <th>User</th>
                            <th>Coupons</th>
                            <th>Products</th>
                            <th>Stores</th>
                            <th>Categories</th>
                            <th>Total Activity</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($report as $row)

                            <tr>

                                <td>
                                    {{ $row['user']->first_name }} {{ $row['user']->last_name }}
                                </td>

                                <td>
                                    {{ $row['coupons'] }}
                                </td>

                                <td>
                                    {{ $row['products'] }}
                                </td>

                                <td>
                                    {{ $row['stores'] }}
                                </td>

                                <td>
                                    {{ $row['categories'] }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $row['total'] }}
                                    </strong>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    No Data Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection