@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <x-forms.create-complaint :pasteId="$pasteId"/>
@endsection