@extends('layouts.dashboard')

@section('content')
    <h1>Lista dei tuoi piatti</h1>
    <div class="d-flex flex-wrap m-10">
        @foreach ($dishes as $dish)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Nome: {{$dish->name}}</h5>
                    <p class="card-text">Ingredienti: {{$dish->ingredients}}</p>
                    <p class="card-text">Tipo: {{$dish->type}}</p>
                    <p class="card-text">Prezzo: {{$dish->price}}</p>
                    <h5>{{$dish->visible}}</h5>
                    <a href="#" class="btn btn-primary">Visualizza</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection