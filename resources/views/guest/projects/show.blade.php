@extends('layouts.guest')

@section('title', $good_project->title)


@section('content')

    

    <section>
        <img src="{{ $good_project->getImageUri() }}" alt="" width="400" class="my-3">
        <p>
            <strong>Descrizione</strong>
            <br>
            {{$good_project->text}}
        </p>

        <a href="{{route('guest.home')}}" class="btn btn-primary">Torna indietro</a>

    </section>

@endsection