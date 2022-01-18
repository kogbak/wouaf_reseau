@extends('layouts.app')
@section('title')
Wouaf Reseau - Acceuil
@endsection



<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

</div>-->

@section('content')
<div class="container">
    <div class="row mt-5">
    <img src="{{ asset('images/logowouaf.png') }}" alt="logo" style="width: 28em;" class="mx-auto">
    </div>

    <div class="cadre border-secondary rounded-3">
        <div class="row mt-5 border ">
            <h3 class="text-center fw-bold">Poster un message</h3>

        </div>
    </div>
</div>
@endsection

