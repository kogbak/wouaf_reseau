@extends('layouts.app')


@section('tiltle')
    Modifier mon commentaire
@endsection


@section('content')

    @if (count($messages) <= 0)

        <div class="container">
            <div class="row text-center mt-5" style="color:#ff2d20;">
                <h3>Il n'y a aucun message, tags ou commentaire correspondant à votre recherche <br> Dsl :'(</h3>
            </div>
        </div>
    @else

        @foreach ($messages as $message)

            <div class="espace container text-center mt-5 shadow-sm rounded-3 mx-auto"
                style="background-color: white; padding: 30px">
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

                        @foreach ($message->comments as $commentaire)

                            <div class="container p-1 w-75 mt-4 rounded-3" style="background-color:#ff2d20; color:white;">
                                <div class="row mt-5  d-flex justify-content-start ">


                                    @if ($commentaire->user->image)
                                        <img src="images/{{ $commentaire->user->image }}" class="rounded-circle ms-5"
                                            alt="logo" style="width: 10%;">
                                    @else
                                        <img src="{{ asset('images/default_user.jpg') }} " class="rounded-circle"
                                            alt="logo" style="width: 5em;">
                                    @endif
                                    <h3 class="d-flex justify-content-start ms-5 mt-2 ">
                                        {{ $commentaire->user->wouafname }}
                                    </h3>
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


                                    <!-- METTRE UN CAN ICI -->@can('delete', $commentaire)
                                        <div class="col-sm-6">
                                            <form method="POST" action="{{ route('commentaire.destroy', $commentaire) }}">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit"
                                                    onclick="return confirm('êtes vous sûres de supprimer le commentaire?')"
                                                    class="boutondeux m-3" value="supprimer">
                                            </form>
                                        </div>
                                    @endcan



                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>



        @endforeach

    @endif


@endsection
