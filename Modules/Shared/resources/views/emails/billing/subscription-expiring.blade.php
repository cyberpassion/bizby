@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Your subscription expires on {{ $expiryDate }}.</p>
<p><a href="{{ $renewUrl }}">Renew Now</a></p>
@endsection
