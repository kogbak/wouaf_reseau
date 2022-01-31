@extends('layouts.app')


@section('tiltle')
    Modifier mon message
@endsection


@section('content')

    <div class="container text-center" style="background-color: white">
        <div class="row">

            <h3 class="mt-5 mb-5 fw-bold ">Modifier mon message</h3>

            <form method="POST" action="{{ route('messages.update', $message) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label for="message" class="mt-3 fs-4">Message : </label>
                    <input type="text" id="message" name="message" value="{{ $message->message }}">
                </div>
                <div>
                    <label for="tags" class="mt-3 fs-4">Tags : </label>
                    
                    <input type="text" id="tags" name="tags" value="{{ $message->tags }}">
                </div>
                <label for="image" class="fs-4 mb-2 mt-3">Image : </label>
                <input type="file" name="image" class="form-control w-25 mx-auto">
                <button type="submit" class="bouton mt-3 mb-3">
                    {{ __('Modifier message') }}
                </button>
            </form>
        </div>
    </div>

@endsection
