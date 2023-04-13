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
    <section class="card">
        <div class="card-body">
            <form action="{{route('admin.projects.store')}}" method="post">
            @csrf
            <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" id="title" class="form-control"/>

                <label for="image" class="form-label">Immagine</label>
                <input type="text" name="imahe" id="imahe" class="form-control"/>

                <label for="text" class="form-label">Testo</label>
                <textarea type="text" name="text" id="text" class="form-control"></textarea>

                <input type="submit" class="btn btn-primary my-3" value="Salva">
            </form>
        </div>
    </section>
@endsection