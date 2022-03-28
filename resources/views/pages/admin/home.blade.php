@extends('layouts.dashboard')
@section('content')
    <h3>Benvenuto {{ $user->name }}</h3>


    <div class="scheda-ristorante">
      <h4>La tua attività:</h4>
      <div class="card">
          {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
          <div class="card-body">
            <h3 class="card-title">{{ $user->restaurant_name }}</h3>
            <p class="card-text">{{ $user->address }}</p>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
          </div>
      </div>
    </div>
@endsection