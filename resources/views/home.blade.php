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


    <?php
    //dd($messages);
    ?>


    @foreach ($messages as $message)

        <div class="container text-center mt-5 shadow-sm rounded-3" style="background-color: white; padding: 30px">
            <div class="row">
                <div class="col-4">
                    @if ($message->user->image)
                    <img src="images/{{ $message->user->image }}" class="rounded-circle" alt="logo" style="width: 5em;"
                            class="">
                    @else
                        <img src="{{ asset("images/default_user.jpg") }} " class="rounded-circle" alt="logo" style="width: 5em;"
                            class="">
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
                <p class="mb-5 mt-3 mx-auto" style="background-color: 
                #1e1e1e; width:20em; color: white; border: 1px solid transparent; border-radius: 7px;">{{ $message->message }}</p>
                <div class="row">
                    <a href="#">
                        <p>zoom sur ce message</p>
                    </a>
                </div>
                <div class="row text-center">
                    <div class="col-sm-4"><button class="bouton">Commenter</button></div>
                    <div class="col-sm-4"><button class="btn btn-warning">Modifier</button></div>
                    <div class="col-sm-4"><button class="btn btn-outline-danger">Supprimer</button></div>
                </div>
            </div>
        </div>

    @endforeach
    
<div class="d-flex justify-content-center mt-5">
{{$messages->links()}}
</div>

@endsection
