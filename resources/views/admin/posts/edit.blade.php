@extends('layouts.dashboard')

@section('content')
    <h1>Modifica il post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        <div class="mb-3">
            {{-- selettore di categoria del post --}}
            <label for="category_id">Categoria</label>
            <select class="form-select" name="category_id" id="category_id">
                <option value="">Nessuna</option>
                
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>        
        </div>

        <div class="mb-3">
            <h5>Tags</h5>
  
            @foreach ($tags as $tag)
            @if ($errors->any())
                {{-- se ci sono errori di validazione vedo dalla old
                    dove mettere checked --}}
                <div class="form-check">
                    <input class="form-check-input" 
                    type="checkbox" 
                    value="{{ $tag->id }}" 
                    id="tag-{{ $tag->id }}" 
                    name="tags[]"
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                      {{ $tag->name }}
                    </label>
                </div>
            @else
            {{-- se non ci sono errori di validazione
                sto caricando la pagina per la prima volta
                valuto la collection dei tags --}}
                <div class="form-check">
                    <input class="form-check-input" 
                    type="checkbox" 
                    value="{{ $tag->id }}" 
                    id="tag-{{ $tag->id }}" 
                    name="tags[]"
                    {{ $post->tags->contains($tag) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endif
                
            @endforeach
          </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" rows="5" name="content">{{ old('content', $post->content) }}</textarea>
        </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        
            {{-- gestione immagine --}}
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input class="form-control" type="file" id="image" name="image">

            @if ($post->cover)
                <div>Immagine corrente:</div>
                <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
            @endif
        </div>

        <input type="submit" value="Salva modifica">
    </form>
@endsection