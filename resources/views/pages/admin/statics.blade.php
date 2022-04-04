@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="pt-3">
        <a href="{{route('admin.home', ['id' => Auth::user()->id])}}">
            <button class="btn btn-back-2"><i class="fa-solid fa-backward mr-2"></i>Torna all'indice del tuo ristorante</button>
        </a>
    </div>

    <h3 class="text-center dishes-title py-4">Il tuo riepilogo degli ordini</h3>

    
    @if(count($restaurant_orders) == 0)
        <h4 class="text-center">Al momento non hai ordini</h4>
    @elseif(count($restaurant_orders) > 0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID ordine</th>
                <th scope="col">Nome</th>
                <th scope="col">Piatto</th>
                <th scope="col">Quantità</th>
                <th scope="col">Data ordine</th>
                <th scope="col">Stato ordine</th>
            </tr>
            </thead>
            <tbody>

                @foreach ($restaurant_orders as $order)
                    @foreach ($order->dishes as $dish)

                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->customer_name}}</td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->quantity}}</td>
                        <td>{{$order->date}}</td>
                        <td>Da consegnare</td>
                    </tr>

                    @endforeach        
                @endforeach

            </tbody>
        </table>
    @endif
    
</div>
@endsection