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
    <h1 class="text-center m-5">Liste des messages</h1>

    @foreach ($messages as $message)

        <div class="container text-center mt-5 shadow-sm rounded-3" style="background-color: white; padding: 30px">
            <div class="row">
                <div class="col-4">
                    @if ($message->user->image)
                        <img src="images/{{ $message->user->image }}" class="rounded-circle" alt="logo"
                            style="width: 5em;" class="">
                    @else
                        <img src="{{ asset('images/default_user.jpg') }} " class="rounded-circle" alt="logo"
                            style="width: 5em;" class="">
                    @endif
                    <h3 class="mt-1">{{ $message->user->wouafname }}</h3>
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
                    <img src="{{ asset("images/$message->image") }}" alt="image_message" style="height: 200px;">
                </div>
            </div>
            <div class="row">
                <p class="mb-5 mt-3 mx-auto"
                    style="background-color: 
                                                        #1e1e1e; width:20em; color: white; border: 1px solid transparent; border-radius: 7px;">
                    {{ $message->message }}</p>
                <div class="row">
                    <a href="#">
                        <p>zoom sur ce message</p>
                    </a>
                </div>
                <div class="row text-center">

                    <div class="col-sm-4">
                        <a href="{{ route('commentaire.create', $message->id) }}" class="bouton text-decoration-none"
                            style="color: white; line-height: 2">Répondre</a>
                    </div>

                    @can('update', $message)
                        <div class="col-sm-4">
                            <a href="{{ route('messages.edit', $message) }}"><button
                                    class="btn btn-warning">Modifier</button></a>
                        </div>
                    @endcan

                    @can('delete', $message)
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('messages.destroy', $message) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit" onclick="return confirm('êtes vous sûres de supprimer le message ?')"
                                    class="btn btn-outline-danger" value="supprimer">
                            </form>
                        </div>
                    @endcan
                </div>
            </div>

            <!-- AFFICHER LES COMMENTAIRE SUR CHAQUE MESSAGE -->
            @foreach ($message->comments as $commentaire)

                <div class="container p-1 w-75 mt-4 rounded-3" style="background-color:#ff2d20; color:white;">
                    <div class="row mt-5  d-flex justify-content-start ">


                        @if ($commentaire->user->image)
                            <img src="images/{{ $commentaire->user->image }}" class="rounded-circle ms-5" alt="logo"
                                style="width: 10%;">
                        @else
                            <img src="{{ asset('images/default_user.jpg') }} " class="rounded-circle" alt="logo"
                                style="width: 5em;">
                        @endif
                        <h3 class="d-flex justify-content-start ms-5 mt-2 ">{{ $commentaire->user->wouafname }}</h3>
                    </div>
                    <div class="row">
                        @if ($commentaire->image)
                            <img src="images/{{ $commentaire->image }}" class="mx-auto rounded-3"
                                style=" width: 400px; border-radius: 2%;">
                        @else
                        @endif

                        <div class="row">
                            <p style="background-color: 
                                        #1e1e1e; width:20em; color: white; border: 1px solid transparent; border-radius: 7px;"
                                class="mx-auto mt-5">{{ $commentaire->content }}</p>
                        </div>
                        <p>{{ $commentaire->tags }}</p>

                        @can('update', $commentaire)
                            <div class="col-sm-6">
                                <a href="{{ route('commentaire.edit', $commentaire) }}"><button
                                        class="btn btn-light m-3">Modifier</button></a>
                            </div>
                        @endcan


<!-- METTRE UN CAN ICI -->
                        <div class="col-sm-6">
                            <form method="POST" action="{{ route('commentaire.destroy', $commentaire) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                    onclick="return confirm('êtes vous sûres de supprimer le commentaire?')"
                                    class="btn btn-light m-3" value="supprimer">
                            </form>
                        </div>



                    </div>
                </div>
            @endforeach

        </div>

    @endforeach

    <div class="d-flex justify-content-center mt-5">
        {{ $messages->links() }}
    </div>

@endsection
