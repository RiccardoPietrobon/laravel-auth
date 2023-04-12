@extends('layouts.app')

@section('title', 'PROGETTI')

@section('actions')
    <div>
        <a href="{{route('admin.projects.create')}}" class="btn btn-dark">
            Nuovo Progetto
        </a>
    </div>
@endsection

@section('content')
    <section>
        <table class="table table-primary">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">TITOLO</th>
                <th scope="col">ABSTRACT</th>
                <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->getAbstract() }}</td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </td>
                    </tr>
                @empty
                    
                @endforelse
                
            </tbody>
        </table>

        {{ $projects->links() }}
    </section>

@endsection