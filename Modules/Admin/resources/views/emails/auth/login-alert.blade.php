@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>A new login was detected:</p>
<ul>
<li>IP: {{ $ip }}</li>
<li>Device: {{ $device }}</li>
</ul>
<p>If this wasn’t you, please secure your account.</p>
@endsection
