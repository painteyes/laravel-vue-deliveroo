@extends('layouts.app')

@section('content')
<div class="container">

    <!-- riga con le info del ristorante -->
    <div class="mx-2 pt-4 checkout-head row d-flex align-items-center">

      <a href="{{route('restaurant', $user->slug)}}" class="text-center">
        <button class="btn">&#171; Torna al ristorante ({{$user->name}})</button>
      </a>

      <div class="title">
        {{-- <h1>{{$user->name}}</h1> --}}
      </div>
    </div>

    <!-- riga con form per pagamento e carrello -->
    <checkout
      :dishes="{{$user->dishes}}"
      :user_id="'{{$user->id}}'"
    ></checkout>

</div>
@endsection