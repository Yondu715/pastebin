@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <x-pastes.create-form :accessRestrictions="$accessRestrictions" :programmingLanguages="$programmingLanguages" :expirationTimes="$expirationTimes"/>
@endsection
