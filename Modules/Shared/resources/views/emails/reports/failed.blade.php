@extends('shared::emails.layout')

@section('content')
<p><strong>{{ $title }}</strong></p>
<p>Report generation failed with error:</p>
<pre>{{ $error }}</pre>
@endsection
