@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>Your registration on <strong>Bizby</strong> is complete 🎉</p>

<p>You can log in using the link below:</p>

<p>
    <a href="{{ $loginUrl }}">Login to Bizby</a>
</p>

<p>We’re glad to have you with us.</p>

<p>— <strong>Team Bizby</strong></p>
@endsection
