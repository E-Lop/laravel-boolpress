@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div><strong>Creato il: </strong>{{ $post->created_at }}</div>
    <div><strong>Aggiornato il: </strong>{{ $post->updated_at }}</div>
    <div><strong>Slug: </strong>{{ $post->slug }}</div>
    <h3 class="mt-2"><strong>Contenuto del post:</strong></h3>
    <p>{{ $post->content }}</p>
    <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">Modifica il post</a>
    <input class="btn btn-danger" type="submit" value="Cancella il post">
@endsection