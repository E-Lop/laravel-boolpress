@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div><strong>Creato il: </strong>{{ $post->created_at->format('l d F Y') }}</div>
    <div><strong>Aggiornato il: </strong>{{ $post->updated_at->format('l d F Y') }}</div>
    <div><strong>Slug: </strong>{{ $post->slug }}</div>
    <h3 class="mt-2"><strong>Contenuto del post:</strong></h3>
    <p>{{ $post->content }}</p>
    <div class="crud_buttons d-flex">
        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">Modifica il post</a>
        <form action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
            @csrf
            @method('DELETE')
            
            <input class="btn btn-danger" type="submit" value="Cancella il post" onclick="return confirm('Confermi di voler cancellare?')">
        </form>
    </div>
@endsection