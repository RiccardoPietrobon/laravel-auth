@extends('layouts.app')

@section('title', ($project->id) ? 'Modifica il Progetto' : 'Crea un nuovo progetto')

@section('actions')
    <div>
        <a href="{{route('admin.projects.index')}}" class="btn btn-dark mx-1">
            Torna indietro
        </a>
        @if ($project->id)
            <a href="{{route('admin.projects.show', $project)}}" class="btn btn-dark mx-1">
            Mostrami il progetto
            </a>
        @endif
        
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

    <section class="card">
        <div class="card-body">

            @if ($project->id) {{-- se il progetto ha un id, quindi esiste già --}}
                <form action="{{route('admin.projects.update', $project)}}" method="post" enctype="multipart/form-data" class="row"> {{-- il form sarà per modificare --}}
                @method('put')
            @else
                <form action="{{route('admin.projects.store')}}" method="post" enctype="multipart/form-data" class="row"> {{-- altrimenti sarà per crearne uno di nuovo --}}
            @endif
            
            @csrf
                <div class="row my-2 justify-content-center">
                    <div class="col-8">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci il nuovo titolo" value="{{old('title', $project->title)}}"/>
                        @error('title')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row my-2 justify-content-center">
                    <div class="col-8">
                        <label for="published" class="form-label">Pubblicato</label>
                        <input type="checkbox" name="published" id="published" class="form-check-control @error('published') is-invalid @enderror" @checked(old('published', $project->published)) value="1"/>
                        @error('published')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row my-2 justify-content-center">
                    <div class="col-5">
                        <label for="image" class="form-label">Immagine</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Inserisci l'immagine"/>
                        @error('title')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <img src="{{ $project->getImageUri() }}" alt=""  width="400">
                    </div>
                </div>
                
                <div class="row my-2 justify-content-center">
                    <div class="col-8">
                        <label for="text" class="form-label">Testo</label>
                        <textarea type="text" name="text" id="text" class="form-control @error('text') is-invalid @enderror" placeholder="Inserisci il nuovo testo">{{ old('text', $project->text) }}</textarea>
                        @error('title')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row my-2 justify-content-end">
                    <div class="col-3">
                        <input type="submit" class="btn btn-primary my-2" value="Salva" id="image-preview">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const imageInputEl = document.getElementById('image');
        const imagePreviewEl = document.getElementById('image-preview');
        const placeholder = imagePreviewEl.src;

        imageInputEl.addEventListener('change', () => {
            if(imageInputEl.files[0] && imageInputEl.files[0]){
                const reader = new FileReader();
                reader.readAsDataURL(imageInputEl.files[0]);

                reader.onload = e => {
                    imagePreviewEl.src = e.target.result;
                }
            } else imagePreviewEl.src = placeholder;
        })
    </script>
@endsection