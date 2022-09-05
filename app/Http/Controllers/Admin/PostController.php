<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->getFreeSlugsFromTitle($new_post->title);

        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getFreeSlugsFromTitle($title) {
        // assegnare slug
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        // verifica se slug esiste già nel db
        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        // Finchè non trovo slug libero, appendo numero allo slug base -1, -2, ecc...
        $counter = 1;
        while($existing_slug_post) {
            // creo nuovo slug con $counter
            $slug_to_save = $slug_base . '-' . $counter;

            // verifico se questo nuovo slug esiste nel database
            $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

            $counter++;
        }

        return $slug_to_save;
    }
}
