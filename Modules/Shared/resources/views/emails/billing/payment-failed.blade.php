@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Your recent payment attempt failed.</p>
<p><a href="{{ $retryUrl }}">Update payment method</a></p>
@endsection
