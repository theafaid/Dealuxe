@extends('layouts.app')

@section('content')
    @foreach($admins as $admin)
    {{$admin}}
    @endforeach
@endsection
