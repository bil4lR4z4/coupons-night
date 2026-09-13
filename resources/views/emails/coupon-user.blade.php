@extends('emails.layout')

@section('content')

<h2>Hello {{ $offer->first_name }},</h2>

<p>
Thank you for submitting your coupon.
</p>

<table width="100%" cellpadding="10">

<tr>
    <td><b>Store URL</b></td>
    <td>{{ $offer->store_url }}</td>
</tr>

<tr>
    <td><b>Coupon Code</b></td>
    <td>{{ $offer->coupon_code }}</td>
</tr>

<tr>
    <td><b>Expiry Date</b></td>
    <td>{{ $offer->expiry_date }}</td>
</tr>

</table>

<p>
Your submission is under review.
</p>

@endsection