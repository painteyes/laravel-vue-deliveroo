@extends('layouts.dashboard')

@section('content')
    <h1>Lista dei tuoi piatti</h1>
    <div class="d-flex flex-wrap m-10">
        @foreach ($dishes as $dish)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/' . $dish->img_path) }}" alt="{{ $dish->name }}">
                <div class="card-body">
                    <h5 class="card-title">Nome: {{$dish->name}}</h5>
                    <p class="card-text">Ingredienti: {{$dish->ingredients}}</p>
                    <p class="card-text">Tipo: {{$dish->type}}</p>
                    <p class="card-text">Prezzo: {{$dish->price}}</p>
                    <h5>{{$dish->visible}}</h5>
                    
                    <form action="{{ route('admin.edit', ['id' => $dish->id]) }}">
                        @csrf

                        <button type="submit" class="btn btn-primary">Modifica</button>
                    </form>

                    <form action="{{ route('admin.destroy', ['id' => $dish->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Vuoi eliminare questo piatto?')">Cancella</button>

                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection