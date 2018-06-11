@extends('layout/ace')

@section('content')
    @foreach($groups as $group)
        {{$group->name}}
    @endforeach
@endsection
