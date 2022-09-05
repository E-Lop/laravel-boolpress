@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div>Creato il {{ $post->created_at }}</div>
    <div>Aggiornato il {{ $post->updated_at }}</div>
    <div>{{ $post->slug }}</div>
    <div class="mt-2">Contenuto del post:</div>
    <p>{{ $post->content }}</p>
@endsection