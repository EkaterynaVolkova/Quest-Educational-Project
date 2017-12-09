<@extends('layouts.dashboard')
@section('style')
    @stop
@section('content')
<h2>Contact form request</h2>
<div>From: {{ $email }}</div>
<div>Message: {{ $message_body }}</div>
@stop