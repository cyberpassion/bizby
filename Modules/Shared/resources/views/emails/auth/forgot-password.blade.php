@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>We received a request to reset your password.</p>

<p>
    <a href="{{ $resetUrl }}">Reset Password</a>
</p>

<p>This link will expire in <strong>60 minutes</strong>.</p>

<p>If you didn’t request this, no action is required.</p>

<p>— <strong>Bizby Security Team</strong></p>
@endsection
