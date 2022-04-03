@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="pt-3">
        <a href="{{route('admin.home', ['id' => Auth::user()->id])}}">
            <button class="btn btn-back-2"><i class="fa-solid fa-backward mr-2"></i>Torna all'indice del tuo ristorante</button>
        </a>
    </div>

    <h3 class="text-center dishes-title py-4">Il tuo riepilogo degli ordini</h3>

   

    
    @foreach ($restaurant_orders as $order)
        {{--   qui abbiamo le informazioni degli ordini --}}

        <div>
            @foreach ($order->dishes as $dish)
                {{-- informazioni dei piatti --}}
                {{-- {{dd($dish)}} --}}
                <h2>{{$order->customer_name}}, {{$order->customer_lastname}}</h2>
                <h5>Piatto: {{$dish->name}}</h5>
                <h5>Prezzo: {{$dish->price}}</h5>
                <h5>Quantità: {{$dish->quantity}}</h5>
            @endforeach

        </div>
        <h5>Data di ordine: {{$order->date}}</h5>
        <div>{{$order->total_price}}</div>
    @endforeach

    
</div>
@endsection