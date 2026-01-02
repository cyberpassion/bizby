@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>We noticed you haven’t logged in recently.</p>
<p><a href="{{ $loginUrl }}">Continue where you left off</a></p>
@endsection
