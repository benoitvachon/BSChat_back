@extends('layout')
@section('welcome')
<div class='valign-wrapper welcome-wrapper'>
    <div class="card welcome">
        <div class="card-content">
            <h1>Studycom<span class="commercial">®</span></h1>
        </div>

        <div class="card-action">
            <a class="btn" href="{{ url('/login') }}">Connexion</a>
            <a class="btn right" href="{{ url('/register') }}">Inscription</a>
        </div>
    </div>  
</div>  


@endsection