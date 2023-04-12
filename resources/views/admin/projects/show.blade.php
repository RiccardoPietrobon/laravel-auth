@extends('layouts.app')

@section('title', $project->title)


@section('content')
    <section>
        <p>
            <strong>Descrizione</strong>
            <br>
            {{$project->text}}
        </p>

        <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna indietro</a>
    </section>

@endsection