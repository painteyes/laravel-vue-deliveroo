@extends('layouts.app')

@section('content')
<div class="container">

    <!-- riga con le info del ristorante -->
    <div class="pt-4 checkout-head row d-flex align-items-center">

      <a href="{{route('restaurant', $user->slug)}}" class="text-center">
        <button class="btn">&#171; Torna al {{$user->restaurant_name}}</button>
      </a>

    </div>

    <!-- riga con form per pagamento e carrello -->
    <checkout
      :dishes="{{$user->dishes}}"
      :user_id="'{{$user->id}}'"
    ></checkout>

</div>
@endsection