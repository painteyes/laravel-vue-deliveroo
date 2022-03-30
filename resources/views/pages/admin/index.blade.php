@extends('layouts.dashboard')

@section('content')
<div class="container-xl">

    <h1 class="dishes-title my-4">Lista dei tuoi piatti</h1>
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($dishes as $dish)
            <div class="card food-card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/' . $dish->img_path) }}" alt="{{ $dish->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{$dish->name}}</h5>
                    <p class="card-text">Ingredienti: {{$dish->ingredients}}</p>
                    <p class="card-text">Tipo di piatto: {{$dish->type}}</p>
                    <p class="card-text"><strong>&euro; {{$dish->price}}</strong></p>

                    @if ($dish->visible == 1)
                        Disponibilità: <i class="fa-solid fa-circle-check green"></i>
                    @elseif ($dish->visible == 0)
                        Disponibilità: <i class="fa-solid fa-circle-minus red"></i>
                    @endif

                    <div class="d-flex mt-3 justify-content-center">
                        <span>
                            <form action="{{ route('admin.edit', ['id' => $dish->id]) }}">
                                @csrf
        
                                <button type="submit" class="btn btn-primary mr-4">Modifica</button>
                            </form>
                        </span>                    
                    
                        <span>
                            <form action="{{ route('admin.destroy', ['id' => $dish->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Vuoi eliminare questo piatto?')">Cancella</button>
                            </form>
                        </span>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection