@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Your account has been temporarily locked due to multiple failed login attempts.</p>
<p>Please try again later or contact support.</p>
@endsection
