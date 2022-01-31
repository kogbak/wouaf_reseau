@extends('layouts.app')
<!-- pouv aoir le gabarie de base de app -->
@section('title')
    Bienvenue sur Wouaf Reseau
@endsection


@section('content')
    <div class="container header">


        <div class="row mt-5">

            <img src="{{ asset('images/logowouaf.png') }}" alt="logo" style="width: 28em;" class="mx-auto">

            <div class="row mt-5 text-center">

                <div class="col-12">

                    <h3 class="mb-5">Bienvenue sur Wouafreseau, <br>Un réseau pour vous et vos chients</h3>

                    <a href="{{ route('login') }}"><button class="bouton me-5">Connexion</button></a>
                    <a href="{{ route('register') }}"><button class="bouton">Inscription</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
