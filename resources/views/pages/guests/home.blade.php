@extends('layouts.app')


@section('content')

        {{-- Jumbotron --}}
        <div class="jumbotron-del">
                <div class="container">
                    <div class="d-flex row-cols-2">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <span class="title-jumbo">
                                    I piatti che ami, a domicilio.
                                    Cerchi qualcosa?
                                </span>
                            </div>
                        </div>
                        <div class="col text-center pt-3">
                            <img src="/images/jumbotron.svg" alt="jumbo-img">
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