@extends('layouts.app')
<!-- pouv avoir le gabarie de base de app -->
@section('title')
    Modification Information
@endsection

@section('content')
    <h3 class="mt-5 mb-5 fw-bold text-center" style="color:#ff2d20;">Profil de {{ $user->wouafname }}</h3>

    <table class="mx-auto mb-5 mt-5">

        <div class="row">
            <div class="col-12 text-center">
                @if ($user->image)
                    <!-- si lutilisateur a limage on affiche son image-->

                    <img src="{{ asset("images/$user->image") }} " alt="logo" style="width: 23em;"
                        class=" rounded-circle mb-5 mt-5">
                @else
                    <!-- sinon on affiche image par default-->
                    <img src="{{ asset('images/default_user.jpg') }} " alt="logo" style="width: 23em;"
                        class="rounded-circle mb-5 mt-5">
                @endif
            </div>
        </div>

        <tr>
            <td class="fw-bold">Nom et prenom : &nbsp</td>
            <td>{{ strtoupper($user->nom) }}&nbsp{{ $user->prenom }}</td>
            <!--Function chaine de caractére en majuscule-->
        </tr>
        <tr>
            <td class="fw-bold">Inscrit le : &nbsp</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <td class="fw-bold">Message posté : &nbsp</td>
            <td>{{ count($user->messages) }}</td>
        </tr>
    </table>




    @foreach ($messages as $message)

        <div class="container text-center mt-5 mb-5 shadow-sm rounded-3" style="background-color: white; padding: 30px">
            <div class="row">
                <div class="col-4">
                    @if ($message->user->image)
                        <img src="{{ asset("images/$user->image") }}" class="rounded-circle" alt="logo"
                            style="width: 5em;" class="">
                    @else
                        <img src="{{ asset('images/default_user.jpg') }} " class="rounded-circle" alt="logo"
                            style="width: 5em;" class="">
                    @endif
                    <a href="{{ route('show', $message->user) }}">
                        <h3 class="mt-1">{{ $message->user->wouafname }}</h3>
                    </a>
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
                    <img src="{{ asset("images/$message->image") }}" alt="image_message" style="height: 300px;" class="rounded-3">
                </div>
            </div>
            <div class="row">
                <p class="mb-5 mt-3 mx-auto d-flex align-items-center justify-content-center"
                    style="background-color: 
                            #2e2e2e; width:20em; color: white; border: 1px solid transparent; border-radius: 7px;height:50px;">
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
        </div>

        <!-- AFFICHER LES COMMENTAIRE SUR CHAQUE MESSAGE -->
        @foreach ($message->comments as $commentaire)

            <div class="container p-2 w-50 mt-4 rounded-3" style="background-color:#ff2d20; color:white;">
                <div class="row mt-5  d-flex justify-content-start ">


                    @if ($commentaire->user->image)
                        <img src="{{ asset("images/$user->image") }}" class="rounded-circle ms-5" alt="logo"
                            style="width: 8%;">
                    @else
                        <img src="{{ asset('images/default_user.jpg') }} " class="rounded-circle" alt="logo"
                            style="width: 5em;">
                    @endif
                    <a href="{{ route('show', $message->user) }}">
                        <h3 class="mt-2 " style="margin-left: 2.5em">{{ $commentaire->user->wouafname }}</h3>
                    </a>
                </div>
                <p class="text-center">{{ $commentaire->tags }}</p>
                <div class="row">
                    @if ($commentaire->image)
                        <img src="{{ asset("images/$commentaire->image") }}" class="rounded-3 mx-auto "
                            style=" width: 400px;">
                    @else
                    @endif

                    <div class="row">

                        <p style="background-color: 
                                                                    #2e2e2e; width:20em; color: white; border: 1px solid transparent; border-radius: 7px;height:50px;"
                            class="mx-auto mt-5 d-flex align-items-center justify-content-center">
                            {{ $commentaire->content }}</p>
                    </div>


                    @can('update', $commentaire)
                        <div class="row text-center">
                            <div class="col-sm-6">
                                <a href="{{ route('commentaire.edit', $commentaire) }}"><button
                                        class="boutondeux mt-3">Modifier</button></a>
                            </div>

                        @endcan


                        <!-- METTRE UN CAN ICI -->
                        <div class="col-sm-6">
                            <form method="POST" action="{{ route('commentaire.destroy', $commentaire) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                    onclick="return confirm('êtes vous sûres de supprimer le commentaire?')"
                                    class="boutonsupprimer ms-5 mt-3" value="Supprimer">
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        @endforeach
    @endforeach
    <div class="d-flex justify-content-center mt-5">
        {{ $messages->links() }}
    </div>
@endsection
