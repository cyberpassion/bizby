@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p><strong>{{ $title }}</strong></p>

<table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
<thead>
<tr style="background:#f3f4f6;">
@foreach($columns as $col)
<th align="left">{{ $col }}</th>
@endforeach
</tr>
</thead>

<tbody>
@foreach($rows as $row)
<tr>
@foreach($row as $cell)
<td>{{ $cell }}</td>
@endforeach
</tr>
@endforeach
</tbody>
</table>

@if($actionUrl)
<p style="margin-top:20px;">
    <a href="{{ $actionUrl }}">View Full Report</a>
</p>
@endif

<p>— Bizby Reports</p>
@endsection
