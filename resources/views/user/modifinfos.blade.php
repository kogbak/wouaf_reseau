@extends('layouts.app')


@section('tiltle')
    Modifier informations
@endsection


@section('content')

    <div class="container text-center w-50" style="background-color: white">
        <div class="row">

            <h3 class="mt-5 mb-5 fw-bold ">Modifier mes informations</h3>

            <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="mt-3 fs-4">Nom : </label>
                    <input type="text" id="nom" name="nom" value="{{ $user->nom }}">
                </div>
                <div>
                    <label for="mail" class="mt-3 fs-4">Prenom : </label>
                    <input type="text" id="prenom" name="prenom" value="{{ $user->prenom }}">
                </div>
                <div>
                    <label for="mail" class="mt-3 mb-2 fs-4">Adresse email : </label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="row mx-auto">
                    
                    <div class="col-md-6 mx-auto">
                        <label for="image" class="fs-4 mt-3">Image : </label>
                        <input type="file" name="image" class="form-control ">
                    </div>
                
            </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="bouton mt-5 mb-5">
                            {{ __('Modifier information') }}
                        </button>
                    </div>
                </div>
            </form>

            <!-- PARTIE MODIFIER MOT DE PASSE -->

            <h3 class="mt-5 mb-5 fw-bold ">Modifier le mot de passe</h3>

            <form method="POST" action="{{ route('modifiermotdepasse') }}">
                @csrf
                @method('PUT')
                <div>
                    <label for="password" class="mt-3 fs-4">Mot de passe actuel : </label>
                    <input type="password" id="password" name="password">
                </div>
                <div>
                    <label for="password" class="mt-3 fs-4">Nouveau mot de passe : </label>
                    <input type="password" id="new_password" name="new_password">
                </div>
                <div>
                    <label for=" password-confirm" class="mt-3 mb-5 fs-4">Confirmer mot de passe : </label>
                    <input id="password-confirm" type="password" name="new_password_confirmation" required
                        autocomplete="new-password">
                </div>
                <button type="submit" class="bouton mt-3 mb-5">
                    {{ __('Modifier mot de passe') }}
                </button>
            </form>
        </div>
    </div>
@endsection
