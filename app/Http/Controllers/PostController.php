<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::all();
        $data['i'] = 1;
        $data['page_title'] = 'Posts';
        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['post'] = new Post();
        $data['page_title'] = 'Posts';
        return view('admin.post.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'status' => 'required',
            'body' => 'required',

        ]);
        $slug = Str::of($request->get( 'title'))->slug('-');
        if(!empty($request->file('image'))){

        $uploadedFile = $request->file('image');

        $filename = time().$uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            'public/'.'posts',
            $uploadedFile,
            $filename
        );
        }

        $post =   Post::create( [
            'title' => $request->get('title'),
            'status' => $request->get( 'status'),
            'category' => $request->get( 'category'),
            'slug' => $slug,
            'body' => $request->get( 'body'),
            'image' => $filename ??'post.png',

        ]);

        return redirect()->route('posts.index')
            ->with('message', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug',$slug)->first();

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {


        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('message', 'Post updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        $notification = array(
            'message' => 'Post deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('posts.index')
            ->with( $notification);
    }
}
