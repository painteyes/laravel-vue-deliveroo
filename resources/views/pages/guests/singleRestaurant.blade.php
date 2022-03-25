@extends('layouts.app')

@section('content')
        {{-- <h1 class="my-4 d-flex justify-content-center">Ciao sono la pagina del Ristorante</h1> --}}

        {{-- <h2>{{ $user }}</h2> --}}

        <restaurant
                :restaurant-info='{{json_encode($user)}}'
                :restaurant-menu='{{json_encode($user->dishes)}}'>
        </restaurant>

@endsection