@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Your subscription plan <strong>{{ $plan }}</strong> is now active.</p>
<p><a href="{{ $invoiceUrl }}">View Invoice</a></p>
@endsection
