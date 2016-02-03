@extends('layouts.signup-layout')

@section('content')

    <div style="background-image: url('/assets/images/ideaing-logo-white-letters.png');
    display: block;
    height: 88px;
    margin: 0 auto 20px;
    width: 230px;">&nbsp;</div>

    <p class="texto">Registration</p>
    <div class="Registro">
        <form>
            <span class="fontawesome-user"></span>
            <input type="text" required placeholder="Name" autocomplete="off">

            <span class="fontawesome-envelope-alt"></span>
            <input type="text" id="email" required placeholder="Email" value="{{ isset($email)?$email:''}}" autocomplete="off">

            <span class="fontawesome-lock"></span>
            <input type="password" name="password" id="password" placeholder="Password" required autocomplete="off">
            <input type="submit" value="Signup" title="Signup">
        </form>
    </div>
@stop

