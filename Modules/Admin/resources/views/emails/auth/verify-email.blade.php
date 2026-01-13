@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Please verify your email address:</p>
<p><a href="{{ $verifyUrl }}">Verify Email</a></p>
<p>This link is valid for 24 hours.</p>
@endsection
