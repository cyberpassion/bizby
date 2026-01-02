@extends('shared::emails.layout')

@section('content')
<p>Hello {{ $name }},</p>
<p>Your report is ready.</p>
<p><a href="{{ $reportUrl }}">View Report</a></p>
@endsection
