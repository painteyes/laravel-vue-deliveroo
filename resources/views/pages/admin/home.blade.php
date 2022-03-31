@extends('layouts.dashboard')

@section('content')
    <div class="container">
      <div class="row my-4">

        <div class="col-12 col-md-6 mb-4">
          <div class="card text-center card-info-res">
            <div class="user_info">
              {{-- se il path dell'imagine conduce ad un file che esiste --}}
              @if (file_exists('storage/' . $user->img_path))
                  <span><img class="img_account" src="{{ asset('storage/' . $user->img_path) }}" alt="{{ $user->restaurant_name }}"></span>
                  
              @else
                  <span><img class="img_account" src="{{ asset('images/noimg.jpg') }}" alt="{{ $user->restaurant_name }}"></span></li>
              @endif
            

              <ul class="mt-3">
                <li><span>{{ $user->restaurant_name }}</span></li>
                <li><span>Email: {{ $user->email }}</span></li>
                <li><span>Indirizzo: {{ $user->address }}</span></li>
                <li><span>P.IVA: {{ $user->vat_number }}</span></li>
                {{-- @if ($user->description)
                    <li><span>Descrizione: {{ $user->description }}<span></li>
                @endif --}}
              </ul>
            </div>
          </div>
        </div>

          <div class="col-12 col-md-6">
              <div class="card card-menu-rt">
                  <div class="dashboard mb-4">

                    <div class="welcome text-center mb-3">
                        Ciao {{ $user->name }}! <br>
                        Benvenuto nella pagina del tuo ristorante!
                    </div>
  
                    <div class="row">
                        <div class="col">
                          <a href="{{ route('admin.dishes', ['id' => Auth::user()->id]) }} class="d-flex justify-content-center">
                              <button class="btn-pr btn mb-3">Visualizza il Menu</button>
                          </a>
                    
                          <a href="{{ route('admin.create', ['id' => Auth::user()->id]) }} class="d-flex justify-content-center">
                              <button class="btn-pr btn">Aggiungi un piatto</button>
                          </a>
                        </div>
  
                        <div class="col">
                          <a href="{{ route('admin.graph', ['id' => Auth::user()->id]) }} class="d-flex justify-content-center">
                              <button class="btn-pr btn mb-3">Statistiche ordini</button>
                          </a>
                       
                            {{-- <a href="{{ route('admin.orders.index') }}" class="d-flex justify-content-center"> --}}
                                <button class="btn-pr btn">Visualizza gli Ordini dell'Attività</button>
                            {{-- </a> --}}
                        </div>
                    </div>
                  </div>
          </div>



      </div>
  </div>
@endsection