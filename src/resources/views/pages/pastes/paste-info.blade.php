@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container d-flex flex-column gap-5 mt-2 mb-2">
        <x-pastes.info-card :paste="$paste" />
    </div>
@endsection
