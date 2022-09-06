@extends('layouts.dashboard')

@section('content')
    <h1>Modifica il post</h1>

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" rows="5" name="content">{{ $post->content }}</textarea>
        </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <input type="submit" value="Salva">
    </form>
@endsection