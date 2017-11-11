@extends('template')

@section('content')
  @if ($result)
        <h1>Data saved </h1>
	@else
		<h1>Data Not saved </h1>
    @endif

@endsection