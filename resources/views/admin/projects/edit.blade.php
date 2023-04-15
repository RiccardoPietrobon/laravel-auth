@extends('layouts.app')

@section('title', $project->title)

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
            <form action="{{route('admin.projects.update', $project)}}" method="post">
                
                @method('put')
                @csrf

                <div class="row my-2">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$project->title}}"/>
                </div>

                <div class="row my-2">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="text" name="image" id="image" class="form-control" value="{{$project->image}}"/>
                </div>

                <div class="row my-2">
                    <label for="text" class="form-label">Testo</label>
                    <textarea type="text" name="text" id="text" class="form-control">{{$project->text}}</textarea>
                </div>

                <input type="submit" class="btn btn-primary my-2" value="Salva">
            
            </form>
        </div>
    </section>
@endsection