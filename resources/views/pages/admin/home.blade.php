@extends('layouts.dashboard')
@section('content')
    <h1>Benvenuto {{ $user->name }} il tuo ristorante è {{ $user->restaurant_name }} </h1>
@endsection