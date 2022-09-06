@extends('layouts.dashboard')

@section('content')
    {{-- messaggio visibile solo dopo cancellazione di un post --}}
    @if ($deleted === 'yes')
        <div class="alert alert-success" role="alert">
            Fumetto eliminato con successo
        </div>
    @endif
    
    <div class="row row-cols-3 gy-5">        

        @foreach ($posts as $post)
            {{-- singolo post --}}
            <div class="col">
                <div class="card mt-2">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                    <h3 class="card-title">{{$post->title}}</h3>
                    <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary">Dettagli</a>
                    </div>
                </div>
            </div>
            {{-- fine songolo post --}}
        @endforeach
    </div>
@endsection