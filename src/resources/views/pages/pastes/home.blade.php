@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container mt-2 mb-2">
        @foreach ($publicPastes as $paste)
            <x-paste-card :paste="$paste"/>
        @endforeach
    </div>
@endsection
