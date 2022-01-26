@extends('layouts.app')


@section('tiltle')
    commentaire
@endsection


@section('content')

    <div class="container text-center" style="background-color: white">
        <div class="row">

            <h3 class="mt-5 mb-5 fw-bold ">Ajout commentaire</h3>

            <form method="POST" action="{{ route('commentaire.store') }}">
                @csrf

                <div>

                    <textarea id="content" class="mt-3 fs-4" type="text" name="content" rows="5" cols="80"
                        placeholder="Ecrivez votre commentaire ici"></textarea>
                </div>

                <div>
                    <label for="image" class="mt-3 fs-4">Image : </label>
                    <input type="text" id="image" name="image">
                </div>

                <div>
                    <label for="tags" class="mt-3 fs-4">Tags : </label>
                    <input type="text" id="tags" name="tags">
                </div>
                <input type="hidden" name="messageId" value="{{ $id }}">
                <button type="submit" class="bouton mt-3 mb-5">
                    {{ __('content') }}
                </button>
            </form>

        </div>
    </div>

@endsection
