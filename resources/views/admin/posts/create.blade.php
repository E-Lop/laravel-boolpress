@extends('layouts.dashboard')

@section('content')
    <h1>Nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
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
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
          </select>        
        </div>  

        <div class="mb-3">
          <h5>Tags</h5>

          @foreach ($tags as $tag)
          <div class="form-check">
            <input class="form-check-input" 
            type="checkbox" 
            value="{{ $tag->id }}" 
            id="tag-{{ $tag->id }}" 
            name="tags[]"
            {{ in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
            <label class="form-check-label" for="tag-{{ $tag->id }}">
              {{ $tag->name }}
            </label>
          </div>
          @endforeach
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Immagine</label>
          <input class="form-control" type="file" id="image" name="image">
        </div>
          @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror

        <div class="mb-3">
          <label for="content" class="form-label">Contenuto</label>
          <textarea class="form-control" id="content" rows="5" name="content">{{ old('content') }}</textarea>
        </div>
          @error('content')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        <input type="submit" value="Salva">
    </form>
@endsection