@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <div class="container d-flex flex-column gap-5 mt-2 mb-2">
        <div class="row">
            @foreach ($pastes as $paste)
            <div class="col-md-6 mb-4">
                <x-pastes.card :paste="$paste"/>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$pastes->links('pagination::bootstrap-4')}}
    </div>
@endsection
