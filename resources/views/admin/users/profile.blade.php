@extends('admin.master')

@section('title', 'Edit Profile')

@section('content')

<div class="container-fluid">

    <x-breadcrumb current-page-title="Edit Profile" />

    <div class="card shadow-sm">

        <div class="card-body">

            <x-form method="post"
                    action="{{ route('admin.profile.update') }}"
                    enctype="multipart/form-data">

                <div class="row row-cols-2">

                    {{-- First Name --}}
                    <x-input
                        type="text"
                        name="first_name"
                        value="{{ auth()->user()->first_name ?? ''}}"
                        placeholder="First Name"
                        label="First Name"
                    />

                    {{-- Last Name --}}
                    <x-input
                        type="text"
                        name="last_name"
                        value="{{ auth()->user()->last_name ?? ''}}"
                        placeholder="Last Name"
                        label="Last Name"
                    />

                    {{-- Username --}}
                    <x-input
                        type="text"
                        name="username"
                        value="{{ auth()->user()->username ?? ''}}"
                        placeholder="Username"
                        label="Username"
                    />

                    {{-- Email --}}
                    <x-input
                        type="email"
                        name="email"
                        value="{{ auth()->user()->email ?? ''}}"
                        placeholder="Email"
                        label="Email"
                    />

                    {{-- Profile Image --}}
                    <div class="col mb-3">

                        <label class="form-label">
                            Profile Image
                        </label>

                        <input type="file"
                               name="image"
                               id="imageInput"
                               class="form-control"
                               accept="image/*">

                        <div class="mt-3">

                            @if(auth()->user()->image)

                                <img src="{{ asset(auth()->user()->image) }}"
                                     id="imagePreview"
                                     width="100"
                                     height="100"
                                     class="rounded-circle border shadow-sm"
                                     style="object-fit: cover;">

                            @else

                                <img src="https://placehold.co/100x100"
                                     id="imagePreview"
                                     width="100"
                                     height="100"
                                     class="rounded-circle border shadow-sm"
                                     style="object-fit: cover;">

                            @endif

                        </div>

                    </div>

                    <div class="col"></div>

                    {{-- Old Password --}}
                    <x-password
                        name="old_password"
                        label="Old Password"
                        placeholder="Enter old password"
                    />

                    {{-- New Password --}}
                    <x-password
                        name="new_password"
                        label="New Password"
                        placeholder="Enter new password"
                    />

                    {{-- Confirm Password --}}
                    <x-password
                        name="confirm_password"
                        label="Confirm Password"
                        placeholder="Enter confirm password"
                    />

                    {{-- Submit --}}
                    <div class="col-12">

                        <button type="submit"
                                class="btn btn-success">

                            Save Changes

                        </button>

                    </div>

                </div>

            </x-form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

    document.getElementById('imageInput').addEventListener('change', function(e) {

        const file = e.target.files[0];

        const preview = document.getElementById('imagePreview');

        if (file) {

            preview.src = URL.createObjectURL(file);

        }

    });

</script>

@endpush