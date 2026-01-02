@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p>{{ $title }}</p>

<table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
    <thead>
        <tr style="background:#f3f4f6;">
            <th align="left">Item</th>
            <th align="left">Due</th>
            <th align="left">Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr style="border-bottom:1px solid #e5e7eb;">
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['due'] ?? '-' }}</td>
            <td>{{ $item['status'] ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@if($actionUrl)
<p style="margin-top:20px;">
    <a href="{{ $actionUrl }}"
       style="display:inline-block;padding:10px 16px;
              background:#2563eb;color:#fff;
              text-decoration:none;border-radius:4px;">
        {{ $actionText ?? 'View All' }}
    </a>
</p>
@endif

<p style="margin-top:24px;">
    — <strong>Bizby Notifications</strong>
</p>
@endsection
