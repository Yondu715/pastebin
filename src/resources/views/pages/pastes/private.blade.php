@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container d-flex flex-column gap-5 mt-2 mb-2">
        @foreach ($pastes as $paste)
            <x-paste-card :paste="$paste"/>
        @endforeach
    </div>
    {{$pastes->links()}}
@endsection
