@extends('layouts.dashboard')

@section('content')
    <h1>Nuovo post</h1>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
          </div>
            @error('title')
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