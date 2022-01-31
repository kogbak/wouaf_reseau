@extends('layouts.app')


@section('tiltle')
    commentaire
@endsection


@section('content')

    <div class="container text-center" style="background-color: white">
        <div class="row">
            <h3 class="mt-5 mb-5 fw-bold ">Ajout commentaire</h3>
            <form method="POST" action="{{ route('commentaire.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <textarea id="content" class="mt-3 fs-4" type="text" name="content" rows="5" cols="80"
                        placeholder="Ecrivez votre commentaire ici"></textarea>
                </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div>
                    <label for="tags" class="fs-4">#Tags : </label>
                    <input type="text" id="tags" name="tags">
                </div>
                <div class="row mx-auto">
                    <label for="image" class="mt-3 fs-4">Image : </label>
                </div>
                <div class="row">
                    <div class="col-12 w-50 mx-auto">
                        <input type="file" name="image" class="form-control mb-3 w-50 mx-auto">
                    </div>
                </div>
                <input type="hidden" name="messageId" value="{{ $id }}">
                <button type="submit" class="bouton mb-5">
                    {{ __('confirmer') }}
                </button>
                </form>

            </div>
        </div>

    @endsection
