@extends('emails.layout')

@section('content')

<h2>New Coupon Submitted</h2>

<table class="info-table">

    <tr>
        <td><strong>Name</strong></td>
        <td>
            {{ $offer->first_name }}
            {{ $offer->last_name }}
        </td>
    </tr>

    <tr>
        <td><strong>Email</strong></td>
        <td>{{ $offer->email }}</td>
    </tr>

    <tr>
        <td><strong>Store URL</strong></td>
        <td>{{ $offer->store_url }}</td>
    </tr>

    <tr>
        <td><strong>Coupon Code</strong></td>
        <td>{{ $offer->coupon_code }}</td>
    </tr>

    <tr>
        <td><strong>Expiry Date</strong></td>
        <td>{{ $offer->expiry_date }}</td>
    </tr>

    <tr>
        <td><strong>Description</strong></td>
        <td>{{ $offer->description }}</td>
    </tr>

</table>

@endsection