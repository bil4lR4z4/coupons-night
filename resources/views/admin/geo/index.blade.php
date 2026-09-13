@extends('admin.master')

@section('title', 'GEO')

@section('content')

<div class="container mt-5">

    <h3>🌍 Geo Restriction Settings</h3>

    <form method="POST" action="{{ route('admin.geo.store') }}">
        @csrf

        <label class="form-label mt-3">Select Blocked Countries</label>

        <select name="blocked_countries[]" class="form-control" multiple size="15">

            @foreach($countries as $country)
            <option value="{{ $country['code'] }}" {{ in_array($country['code'], $blocked) ? 'selected' : '' }}>

                {{ $country['name'] }} ({{ $country['code'] }})
            </option>
            @endforeach

        </select>

        <button type="submit" class="btn btn-primary mt-3">
            Save Settings
        </button>

    </form>

</div>

@endsection