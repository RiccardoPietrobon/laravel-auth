@extends('layouts.app')

@section('title', 'Crea nuovo progetto')

@section('actions')
    <div>
        <a href="{{route('admin.projects.index')}}" class="btn btn-dark">
            Torna indietro
        </a>
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

    <section class="card">
        <div class="card-body">
            <form action="{{route('admin.projects.store')}}" method="post">
            @csrf
                <div class="row my-2">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci il nuovo titolo" value="{{old('title')}}"/>
                    @error('title')    
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="row my-2">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="url" name="image" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Inserisci il nuovo url dell'immagine" value="{{old('image')}}"/>
                    @error('title')    
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="row my-2">
                    <label for="text" class="form-label">Testo</label>
                    <textarea type="text" name="text" id="text" class="form-control @error('text') is-invalid @enderror" placeholder="Inserisci il nuovo testo">{{ old('text') }}</textarea>
                    @error('title')    
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <input type="submit" class="btn btn-primary my-2" value="Salva">
            </form>
        </div>
    </section>
@endsection