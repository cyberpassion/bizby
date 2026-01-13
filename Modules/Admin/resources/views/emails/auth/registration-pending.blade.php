@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>You started registering on Bizby but didn’t finish.</p>

<p>Your details are saved — you can continue here:</p>

<p>
    <a href="{{ $resumeUrl }}">Complete Registration</a>
</p>

<p>If you need help, just reply to this email.</p>

<p>— <strong>Team Bizby</strong></p>
@endsection
