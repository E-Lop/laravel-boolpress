<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::paginate(6);

        $data = [
            'success' => true,
            'results' => $posts
        ];
        
        return response()->json($data);
    }

    // cerca il post corrispondente a $slug nella tabella 'slug' del db
    // associa il risultato a $data
    // ritorna un JSON con il contenuto del post
    // with() effettua una JOIN per recuperare i dati di 'slug' e 'category'
    public function show($slug) {
        $post = Post::where('slug', '=', $slug)with(['slug', 'category'])->first();

        $data = [
            'success' => true,
            'results' => $post
        ];

        return response()->json($data);
    }
}
