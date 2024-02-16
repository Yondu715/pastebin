@extends('layouts.app')
@section('header')
    <x-header />
@endsection
@section('content')
    <x-complaints.create-form :pasteId="$pasteId"/>
@endsection