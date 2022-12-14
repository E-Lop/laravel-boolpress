<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPostEmailToAdmin;
use Illuminate\Support\Facades\Mail;

Date::setLocale('it');

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        // lettura dati cancellazione post
        $page_data = $request->all();
        $deleted = isset($page_data['deleted']) ? $page_data['deleted'] : null;       

        $data = [
            'posts' => $posts,
            'deleted' => $deleted
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
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // prerequisito di validazione dei dati
        $validateData = $request->validate($this->getValidationRules());

        $form_data = $request->all();

        // se l'immagine esiste
        if(isset($form_data['image'])) {
            // carico l'immagine nella cartella post-covers e 
            // ottengo img_path dell'immagine
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }

        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->getFreeSlugsFromTitle($new_post->title);

        $new_post->save();

        // dopo aver salvato il post appendo i tag
        if(isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }
        
        // invio email ad amministratore alla pubblicazione di un post
        Mail::to('admin@boolpress.it')->send(new NewPostEmailToAdmin($new_post));

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
        $data_creato_italiana = $post->created_at->translatedFormat('d F Y');
        $data_modificato_italiana = $post->updated_at->translatedFormat('d F Y');

        $data = [
            'post' => $post,
            'data_creato_italiana' => $data_creato_italiana,
            'data_modificato_italiana' => $data_modificato_italiana,
        ];
        // dd($data);
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
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
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
        $request->validate($this->getValidationRules());
        
        $form_data = $request->all();
        
        // post da aggiornare preso dal db
        $post_to_update = Post::findOrFail($id);

        // Gestione immagine:
        // se l'immagine ?? presente in $form_data
        if(isset($form_data['image'])) {
            // cancello dal disco la vecchia immagine
            if($post_to_update->cover) {
                Storage::delete($post_to_update->cover);
            }

            // upload del nuovo file
            $img_path = Storage::put('post-covers', $form_data['image']);
            // popolo $form_data['cover'] con $img_path
            $form_data['cover'] = $img_path;
        }
        
        // aggiungere slug all'array dei nuovi dati
        // ricalcolo slug solo se cambia il titolo
        if($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->getFreeSlugsFromTitle($form_data['title']);
            // altrimenti rimane quello gi?? nel db
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->update($form_data);

        // aggiungo i tag
        if(isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post'=> $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);

        // se il post contiene una immagine la rimuovo dal disco
        if($post_to_delete->cover) {
            Storage::delete($post_to_delete->cover);
        }

        // prima di eliminare il post rimuovo tutti i tag
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index', ['deleted' => 'yes']);
    }

    protected function getFreeSlugsFromTitle($title) {
        // assegnare slug
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        // verifica se slug esiste gi?? nel db
        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        // Finch?? non trovo slug libero, appendo numero allo slug base -1, -2, ecc...
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

    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'image' => 'nullable|file|mimes:jpeg,jpg,bmp,png'
        ];
    }
}
