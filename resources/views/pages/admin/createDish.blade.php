@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>Crea il tuo piatto</h2>

        <form action="{{ route('admin.store', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Plate Name --}}
            <div class="mb-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            {{-- Ingredients --}}
            <div class="mb-3">
                <label for="ingredients">Ingredienti</label>
                <input type="text" class="form-control" id="ingredients" name="ingredients" value="{{ old('ingredients') }}">
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price">Prezzo</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div> 

            {{-- Plate Type --}}
            <div class="mb-3">
                <label for="type">Tipologia</label>
                <select class="form-select" id="type" name="type" aria-label="Default select example">
                    <option value="" selected>Seleziona la categoria del piatto</option>
                    <option value="antipasto">Antipasto</option>
                    <option value="primo">Primo</option>
                    <option value="secondo">Secondo</option>
                    <option value="secondo">Contorno</option>
                    <option value="secondo">Dolce</option>
                </select>
            </div>

            {{-- Check for Aviable --}}
            <div class="form-check">
                <input class="form-check-input" type="radio" name="visible" id="visible" value="1" checked>
                <label class="form-check-label" for="visible">
                  Disponibile
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="visible" id="visible" value="0">
                <label class="form-check-label" for="visible">
                  Non disponibile
                </label>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="img_path" class="form-label">Image</label>
                <input type="file" id="img_path" name="img_path">
            </div>

            
            <button type="submit" class="btn btn-primary">Submit</button>
        <form>
    </div>
@endsection