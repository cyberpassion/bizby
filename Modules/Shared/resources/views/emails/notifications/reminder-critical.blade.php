@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<div style="padding:16px;background:#fee2e2;border-radius:6px;">
    <strong>Action Required</strong><br><br>
    {{ $content }}
</div>

<p style="margin-top:24px;">
    <a href="{{ $actionUrl }}"
       style="display:inline-block;padding:12px 18px;
              background:#dc2626;color:#fff;
              text-decoration:none;border-radius:4px;">
        {{ $actionText }}
    </a>
</p>

<p style="margin-top:24px;">
    — <strong>Bizby Alerts</strong>
</p>
@endsection
