@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center ok-page">
      <div class="card payed card-shadow" style="width: 50rem;">
          <div class="card-body">
            <h2 class="card-title"><i class="fa-solid fa-circle-check mr-2 green-2"></i>La transazione è avvenuta con successo</h2>
            <h6 class="card-subtitle mb-2 text-muted">Ti ringraziamo per aver scelto il nostro ristorante e i servizi di Deliveboo</h6>
            <p class="card-text">Riceverai una mail di riepilogo del tuo ordine.<br>
            Nel frattempo, il nostro staff sta preparando il tuo ordine, lo riceverai appena possibile grazie alla rete di rider di Deliveboo.</p>
            <div class="d-flex justify-content-center">
              <img src="{{asset('images/logo.svg')}}" style="width: 15rem;" alt="logo">
            </div>
          </div>
        </div>
    </div>
@endsection