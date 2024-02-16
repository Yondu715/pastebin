@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container d-flex flex-row gap-5 mt-2 mb-2">
        <div class="row">
            <span>Последние 10 паст в системе</span>
            @foreach ($publicPastes as $paste)
            <div class="col-md-6 mb-4">
                <x-paste-card :paste="$paste"/>
            </div>
            @endforeach
        </div>
        @auth
        <div class="row">
            <span>Мои последние пасты </span>
            @foreach ($privatePastes as $paste)
            <div class="col-md-6 mb-4">
                <x-paste-card :paste="$paste"/>
            </div>
            @endforeach
        </div>
        @endauth
    </div>
@endsection
