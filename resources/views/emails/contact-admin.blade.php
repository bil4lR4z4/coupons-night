@extends('emails.layout')

@section('content')

<h2>New Contact Message Received</h2>

<table class="info-table">

    <tr>
        <td><strong>Name</strong></td>
        <td>
            {{ $messageData->first_name }}
            {{ $messageData->last_name }}
        </td>
    </tr>

    <tr>
        <td><strong>Email</strong></td>
        <td>{{ $messageData->email }}</td>
    </tr>

    <tr>
        <td><strong>Subject</strong></td>
        <td>{{ $messageData->sbject }}</td>
    </tr>

    <tr>
        <td><strong>Message</strong></td>
        <td>{{ $messageData->message }}</td>
    </tr>

</table>

@endsection