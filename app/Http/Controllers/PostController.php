<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Actions\PostUpdateAction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with('category', 'user')->latest()->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StorePostRequest $request)

    public function store(StorePostRequest $request)
    {
        $imageName = $request->file('image')->store('public/post');
        // $imageName = $request->image->store('post');
        Post::create([
            'nom_objet' => $request->nom_objet,
            'description' => $request->description,
            'dco' => $request->dco,
            'image' => $imageName
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre objet à bien été enregistré.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // ##### 1ERE MÉTHODE EDIT" #######
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('post.edit', [
            'categories' => $categories, 
            'post' => $post
        ]);
    }

    //   ######### 2e MÉTHODE EDIT ###################

    // public function edit(Post $post)
    // {
    //     if (Gate::denies('update-post', $post)) {
    //         abort(403);
    //     }

    //     $categories = Category::all();

    //     return view('post.edit', compact('post', 'categories'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // ########### TEST #######

    public function update(Request $request, Post $post)
    {
        // 1. La validation

    // Les règles de validation pour "title" et "content"
    $rules = [
        'nom_objet' => 'bail|required|string|max:255',
        "description" => 'bail|required',
        "dco" => 'bail|required',

    ];

    // Si une nouvelle image est envoyée
    if ($request->has("image")) {
        // On ajoute la règle de validation pour "picture"
        $rules["image"] = 'bail|required|image|max:1024';
    }

    $this->validate($request, $rules);

    // 2. On upload l'image dans "/storage/app/public/posts"
    if ($request->has("image")) {

        //On supprime l'ancienne image
        Storage::delete($post->picture);

        $chemin_image = $request->image->store("post");
    }

    // 3. On met à jour les informations du Post
    $post->update([
        "nom_objet" => $request->nom_objet,
        "image" => isset($chemin_image) ? $chemin_image : $post->image,
        "description" => $request->description,
        "dco" => $request->dco
    ]);

    // 4. On affiche le Post modifié : route("posts.show")
    return redirect(route("posts.show", $post));
    }


    // ########### A VOIR ######

    // public function update(Request $request,  Post $post, UpdatePostRequest $postUpdateAction)
    // // UpdatePostRequest $request,
    // {
    //     if (Gate::denies('update-post', $post)) {
    //         abort(403);
    //     }

    //     $postUpdateAction->handle($request, $post);

    //     return redirect()->route('dashboard')->with('success', 'Votre post a été modifié');
    // }

#################################################

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    // ############ OK ############
    public function destroy(Post $post, $id_post)

    //  public function destroy(Post $post)
    {
        // if (Gate::denies('delete-post', $post)) {
        //     abort(403);
        // }
        $post->delete();
        try {
            DB::table('posts')
                ->where('id', '=', $id_post)
                ->delete();
            return redirect()->back()
                ->with('success', 'Post a été supprimé avec succès!');

        } catch(Exception $error) {
            return redirect()->back()
                ->with('error', 'problème de suppression du post!');
        }
        
        return redirect()->route('dashboard')->with('success', 'Votre post a été supprimé');
    }
}
