<!-- resources/views/admin/upcoming-events/create.blade.php -->
@extends('admin.master')

@section('title', 'Upcoming Event')

@section('content')


<div class="container-fluid py-4">
   <x-breadcrumb parent-label="Upcoming Event" 
        :parent-route="route('admin.events.index')"
        current-page-title="Add Upcoming Event" />
    <div class="card border-0 shadow-sm rounded-4">

     
        <!-- <div class="card-header bg-dark text-white py-3 rounded-top-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="mb-0">Create Upcoming Event</h3>
                    <small>Add new upcoming event</small>
                </div>

                <a href="{{ route('admin.upcoming-events.index') }}"
                   class="btn btn-light">

                    Back

                </a>

            </div>

        </div> -->

        <div class="card-body p-4">

            <form action="{{ route('admin.upcoming-events.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Event Title
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control form-control-lg"
                               placeholder="Black Friday Sale">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Subtitle
                        </label>

                        <input type="text"
                               name="subtitle"
                               class="form-control form-control-lg"
                               placeholder="Biggest sale event">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
                               class="form-control form-control-lg">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            End Date
                        </label>

                        <input type="date"
                               name="end_date"
                               class="form-control form-control-lg">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Button Text
                        </label>

                        <input type="text"
                               name="button_text"
                               class="form-control form-control-lg"
                               placeholder="Get Deal">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Button Link
                        </label>

                        <input type="text"
                               name="button_link"
                               class="form-control form-control-lg"
                               placeholder="https://">

                    </div>

                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-bold">
                            Badge Text
                        </label>

                        <input type="text"
                               name="badge_text"
                               value="UPCOMING"
                               class="form-control form-control-lg">

                    </div>

                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-bold">
                            Background Color
                        </label>

                        <input type="color"
                               name="background_color"
                               class="form-control form-control-color">

                    </div>

                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-bold">
                            Button Color
                        </label>

                        <input type="color"
                               name="button_color"
                               class="form-control form-control-color">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Event Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control form-control-lg">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select form-select-lg">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <button class="btn btn-dark btn-lg px-5">

                    Save Event

                </button>

            </form>

        </div>

    </div>

</div>

@endsection