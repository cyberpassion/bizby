@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>{{ $content }}</p>

@if($actionUrl)
    <p style="margin:24px 0;">
        <a href="{{ $actionUrl }}"
           style="display:inline-block;padding:10px 16px;
                  background:#2563eb;color:#ffffff;
                  text-decoration:none;border-radius:4px;">
            {{ $actionText ?? 'View Details' }}
        </a>
    </p>
@endif

<p style="margin-top:24px;">
    — <strong>Bizby Notifications</strong>
</p>
@endsection
