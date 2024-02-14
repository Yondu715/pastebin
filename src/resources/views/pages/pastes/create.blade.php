@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <x-forms.create-paste :accessRestrictions="$accessRestrictions" :programmingLanguages="$programmingLanguages" :expirationTimes="$expirationTimes"/>
@endsection
