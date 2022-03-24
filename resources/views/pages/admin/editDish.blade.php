@extends('layouts.dashboard')

@section('content')
    <h2>Modifica il piatto {{ $dish->name }}</h2>
    <form action="{{ route('admin.update', ['id' => $dish->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="ingredients">Ingredienti</label>
            <input type="text" class="form-control" id="ingredients" name="ingredients" value="{{ old('ingredients') }}">
        </div>

        <div class="mb-3">
            <label for="price">Prezzo</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div> 

        <div class="mb-3">
            <label for="type">Tipologia</label>
            <select class="form-select" id="type" name="type" aria-label="Default select example">
                <option value="" selected>Seleziona la categoria del piatto</option>
                <option value="antipasto">Antipasto</option>
                <option value="primo">Primo</option>
                <option value="secondo">Secondo</option>
            </select>
        </div>

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

        {{-- <div class="form-group">
            <label for="img_path">Scegli l'immagine del piatto</label>
            <input type="file" class="form-control-file" id="img_path">
        </div> --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    <form>
@endsection