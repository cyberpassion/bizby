@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>Your one-time login code is:</p>

<div style="margin:24px 0;padding:16px;background:#f3f4f6;text-align:center;
            border-radius:6px;font-size:24px;font-weight:bold;letter-spacing:4px;">
    {{ $otp }}
</div>

<p>This code is valid for <strong>5 minutes</strong>.</p>

<p>If you did not request this, please ignore this email.</p>

<p>— <strong>Bizby Security Team</strong></p>
@endsection
