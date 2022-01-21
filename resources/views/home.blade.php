@extends('layouts.app')
@section('title')
    Wouaf Reseau - Acceuil
@endsection
@section('content')
    <div class="container w-50">
        <div class="row mt-5">
            <img src="{{ asset('images/logowouaf.png') }}" alt="logo" style="width: 28em;" class="mx-auto">
        </div>
        <div class="rounded-3" style="background-color: white">
            <div class="row mt-5">
                <h3 class="text-center fw-bold mt-5 mb-5">Poster un message</h3>
                <form method="POST" action="{{ route('messages.store') }}" class="text-center">
                    @csrf
                    <label for="message" class="mt-3 mb-3 fs-4">Ecris ton message : </label>
                    <div>
                        <textarea id="message" type="text" name="message" rows="5" cols="80"
                            placeholder="Wouaf, bienvenue !"></textarea>
                    </div>
                    <div class="row mx-auto">
                        <div class="col-6">
                            <div class="row">
                                <label for="image" class="mt-3 mb-3 fs-4">Ajoute une image : </label>
                            </div>
                            <input type="text" id="image" name="image" size="30">
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <label for="tags" class="mt-3 mb-3 fs-4">Ajoute des tags : </label>
                            </div>
                            <input type="text" id="tags" name="tags" size="30">
                        </div>
                    </div>
                    <button type="submit" class="bouton mt-5 mb-5">
                        {{ __('Envoyer') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <h1>Liste des messages</h1>
    <?php
//dd($messages)
    ?>
    @foreach ($messages as $message)

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $userId->image }}" alt="photo_de_profil">
                    <h3>{{ $userId->wouafname }}</h3>
                </div>
                <div class="col-4">
                    <p>{{ $message->tags }}</p>
                </div>
                <div class="col-4">
                    @php
                        $mytime = Carbon\Carbon::now();
                        echo $mytime->toDateTimeString();
                    @endphp
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <img src="{{ $message->image }}" alt="image_message">
                </div>
            </div>
            <div class="row">
                <p>{{ $message->message }}</p>
                <div class="row">
                    <a href="#">
                        <p>zoom sur ce message</p>
                    </a>
                </div>
                <div class="row d-flex flex-row">
                    <button class="btn btn-primary">Commenter</button>
                    <button class="btn btn-primary">Modifier</button>
                    <button class="btn btn-primary">Supprimer</button>
                </div>
            </div>
        </div>

    @endforeach

@endsection
