@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>

<p><strong>{{ $title }}</strong></p>

<table width="100%" cellpadding="6">
@foreach($metrics as $label => $value)
<tr>
    <td>{{ $label }}</td>
    <td align="right"><strong>{{ $value }}</strong></td>
</tr>
@endforeach
</table>

@if($actionUrl)
<p style="margin-top:20px;">
    <a href="{{ $actionUrl }}">View Full Report</a>
</p>
@endif

<p>— Bizby Reports</p>
@endsection
