@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <h3>Dati utente</h3>
                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome completo') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            {{-- End Name --}}

                            {{-- E-mail --}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                            {{-- End E-mail --}}

                            {{-- Password --}}
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- End Password --}}

                            {{-- Confirm Password --}}
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma la password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- End Confirm Password --}}

                            <h3>Dati del ristorante</h3>

                            {{-- Restaurant Name --}}
                            <div class="form-group row">
                                <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">{{ __('Nome del ristorante') }}</label>
                                <div class="col-md-6">
                                    <input id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus>
                                </div>
                            </div>
                            {{-- End Restaurant Name --}}

                            {{-- Address --}}
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                </div>
                            </div>
                            {{-- End Address --}}

                            {{-- Vat Number --}}
                            <div class="form-group row">
                                <label for="vat_number" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label>

                                <div class="col-md-6">
                                    <input id="vat_number" type="text" class="form-control @error('vat_number') is-invalid @enderror" name="vat_number" value="{{old('vat_number')}}">
                                </div>
                            </div>
                            {{-- End Vat Number --}}

                            {{-- Categories --}} 
                            <div class="form-group row">
                                <p class="col-md-4 col-form-label text-md-right"
                                >Spunta la tipologia del tuo ristorante</p>
                                <div class="col-md-4">
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input 
                                                type="checkbox" 
                                                name="categories[]" 
                                                value="{{$category->id}}" 
                                                id='category-{{$category->id}}' 
                                                class="form-check-input"
                                                {{in_array($category->id, old('categories', [])) ? 'checked' : ''}}
                                            >
                                            <label 
                                                for="category-{{$category->id}}" 
                                                class="checkboxesSearch @error('category') is-invalid @enderror" 
                                                name="category" 
                                                value="{{old('category')}}"
                                            >{{$category->name}}</label>
                                        </div>
                                    @endforeach 
                                </div>
                            </div>
                            {{-- End Categories --}}

                            {{-- Img Path --}}
                            <div class="form-group row">
                                <label for="img_path" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="img_path" type="file" class="@error('img_path') is-invalid @enderror" name="img_path">
                                </div>
                            </div>
                            {{-- End Img Path --}}

                            {{-- Description --}}
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <textarea id="description" rows="3" class="form-control col-md-6" name="description" value="{{ old('description') }}"></textarea>
                            </div>
                            {{-- End Description --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
