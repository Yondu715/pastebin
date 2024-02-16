@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container">
        <div class="d-flex row flex-row justify-content-between mt-2 mb-2">
            <div class="col-12  {{ Auth::check() ? 'col-md-6' : '' }}">
                <div class="text-center">
                    <span class="fs-4">Последние 10 паст</span>
                </div>
                @foreach ($publicPastes as $paste)
                    <div class="mb-4">
                        <x-paste-card :paste="$paste" />
                    </div>
                @endforeach
            </div>
            @auth
                <div class="col-12 col-md-6">
                    <div class="text-center">
                        <span class="fs-4">Мои последние пасты</span>
                    </div>
                    @foreach ($privatePastes as $paste)
                        <div class="mb-4">
                            <x-paste-card :paste="$paste" />
                        </div>
                    @endforeach
                </div>
            @endauth
        </div>
    </div>
@endsection
