<h2>New Coupon Submitted</h2>

<p><strong>Name:</strong> {{ $offer->full_name }}</p>
<p><strong>Email:</strong> {{ $offer->email }}</p>
<p><strong>Store URL:</strong> {{ $offer->store_url }}</p>
<p><strong>Coupon Code:</strong> {{ $offer->coupon_code ?? 'N/A' }}</p>
<p><strong>Expiry Date:</strong> {{ $offer->expiry_date ?? 'N/A' }}</p>

<p><strong>Description:</strong></p>
<p>{{ $offer->description ?? 'N/A' }}</p>