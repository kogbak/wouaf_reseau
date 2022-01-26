@extends('layouts.app')


@section('tiltle')
    Modifier mon commentaire
@endsection


@section('content')

    <div class="container text-center" style="background-color: white">
        <div class="row">

            <h3 class="mt-5 mb-5 fw-bold ">Modifier mon commentaire</h3>

            <form method="POST" action="{{ route('commentaire.update', $commentaire) }}">
                @csrf
                @method('PUT')
                <div>
                    <label class="mt-3 fs-4">Commentaire : </label>
                    <input type="text" id="message" name="commentaire" value="{{ $commentaire->content }}">
                </div>
                <div>
                    <label for="image" class="mt-3 fs-4">Image : </label>
                    <input type="text" id="image" name="image" value="{{ $commentaire->image }}">
                </div>
                <div>
                    <label for="tags" class="mt-3 fs-4">Tags : </label>
                    <input type="text" id="tags" name="tags" value="{{ $commentaire->tags }}">
                </div>

                <button type="submit" class="bouton mt-3 mb-5">
                    {{ __('Modifier commentaire') }}
                </button>
            </form>
        </div>
    </div>

@endsection