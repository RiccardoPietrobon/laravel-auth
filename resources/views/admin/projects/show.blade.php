@extends('layouts.app')

@section('title', $project->title)


@section('content')

    

    <section>
        <img src="{{ $project->image ? asset('storage/' . $project->image) : "https://img.freepik.com/free-vector/luxury-gradient-modern-abstract-background_343694-1911.jpg"}}" alt="" width="400" class="my-3">
        <p>
            <strong>Descrizione</strong>
            <br>
            {{$project->text}}
        </p>

        <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna indietro</a>
        <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary">Modifica</a>

    </section>

@endsection