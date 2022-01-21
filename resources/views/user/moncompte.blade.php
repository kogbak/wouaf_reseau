@extends('layouts.app')
<!-- pouv avoir le gabarie de base de app -->
@section('title')
    Modification Information
@endsection

@section('content')

    <div class="container text-center">
        <div class="row">

            <h3 class="mt-5 mb-5 fw-bold">Compte client</h3>

            @if ($user->image)
                <!-- si lutilisateur a limage on affiche son image-->

                <img src="{{ asset("images/$user->image") }} " alt="logo" style="width: 23em;" class="mx-auto mb-5 mt-5">



            @else
                <!-- sinon on affiche image par default-->

                <img src="{{ asset('images/default_user.jpg') }} " alt="logo" style="width: 23em;"
                    class="mx-auto mb-5 mt-5">


            @endif

            <table class="text-center mb-5 mt-5">

                <tr>
                    <td class="fw-bold">Prenom : </td>
                    <td>{{ $user->prenom }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Nom : </td>
                    <td>{{ $user->nom }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Image : </td>
                    <td>{{ $user->image }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Email : </td>
                    <td>{{ $user->email }}</td>
                </tr>

            </table>

        </div>
        <a href="{{ route('modifier') }}"><button class="bouton mt-5">modifier les informations</button></a>
    </div>

@endsection
