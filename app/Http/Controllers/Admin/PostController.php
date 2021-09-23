<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:40',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();

        if(array_key_exists('image',$data)){
            $img_path = Storage::put('covers',$data['image']);
            $data['cover'] = $img_path;
        }


        $newPost = new Post();
        $slug = Str::slug($data['title'], '-');
        $slugI = $slug;
        $slugp = Post::where('slug', $slug)->first();
        $count = 1;
        while($slugp){
            $slug = $slugI . '-' . $count;
            $slugp = Post::where('slug', $slug)->first();
            $count ++;
        }
        $newPost->slug = $slug;
        $newPost->fill($data);
        $newPost->save();

        if(array_key_exists('tags',$data)){
            $newPost->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('crea','post creato con successo. Id post:' .$newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tags = Tag::all();
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:40',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();

        if(array_key_exists('image',$data)){
            $img_path = Storage::put('covers',$data['image']);
            Storage::delete($post->cover);
            $data['cover'] = $img_path;
        }

        if($data['title'] != $post->title){
            $slug = Str::slug($data['title'], '-');
            $slugI = $slug;
            $slugp = Post::where('slug', $slug)->first();
            $count = 1;
            while($slugp){
                $slug = $slugI . '-' . $count;
                $slugp = Post::where('slug', $slug)->first();
                $count ++;
            }
            $data['slug'] = $slug;
        }
        $post->update($data);

        if(array_key_exists('tags',$data)){
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('modifica','post modificato con successo. Id post:' .$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Storage::delete($post->cover);

        return redirect()->route('admin.posts.index')->with('delete','post eliminato con successo. Id post:' .$post->id);
    }
}
