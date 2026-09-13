@extends('emails.layout')

@section('content')

<h2>Hello {{ $messageData->first_name }},</h2>

<p>
Thank you for contacting us.
We have received your message successfully.
</p>

<p>
Our team will get back to you shortly.
</p>

<p>
Regards,<br>
{{ config('app.name') }}
</p>

@endsection