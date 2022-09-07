@extends('layouts.dashboard')

@section('content')
    <h1>Modifica il post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
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
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>        
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" rows="5" name="content">{{ old('content', $post->content) }}</textarea>
        </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="submit" value="Salva">
    </form>
@endsection