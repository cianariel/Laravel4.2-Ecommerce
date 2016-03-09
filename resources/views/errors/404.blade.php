@extends('layouts.main')

@section('body-class'){{ 'error-page' }}@stop

@section('content')
<div id="hero">
    <div class="hero-background"></div>
    <a class="register-btn btn" href="/register"></a>
    <a class="facebook-btn btn" href="https://www.facebook.com/ideaingsmarterliving"></a>
</div>
    
@stop