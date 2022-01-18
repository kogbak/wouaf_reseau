@extends('layouts.app') <!-- pouv aoir le gabarie de base de app -->
@section('title')
Bienvenue sur Wouaf Reseau
@endsection


@section('content')
<div class="container">


<div class="row mt-5">

<img src="{{ asset('images/logowouaf.png') }}" alt="logo" style="width: 28em;" class="mx-auto">

<div class="row mt-5 text-center">

<div class="col-12">
    
<a href="{{ route('login') }}"><button class="btn btn btn-danger ">Connexion</button></a> 
<a href="{{ route('register') }}"><button class="btn btn-outline-danger ms-5">Inscription</button></a>
</div>
</div>
</div>
</div>
@endsection

