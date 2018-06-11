@extends('layout/ace')

@section('content')

    @foreach ($roles as $role)
    {{$role}}
    @endforeach

    {{$ua}}

@endsection
