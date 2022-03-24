@extends('layouts.app')


@section('content')

        {{-- Jumbotron --}}
        
        <div class="hero text-center">
                <div class="container-hp">
                   <div class="display-1 sfondo">
                     <div class="main-logo">
                      
                    </div>
                    <div class="main-headline">
                      <h1>I piatti che ami, a domicilio.</h1>
                      <h3>Cerchi qualcosa?</h3>
                    </div>
                  </div>
                </div>
        </div>

        {{-- Componente Vue per ricercare i ristoranti --}}
        <search-restaurants 
                :rand-restaurants = "{{json_encode($randomRestaurants)}}"
                :categories = "{{json_encode($categories)}}"
        ></search-restaurants>

@endsection