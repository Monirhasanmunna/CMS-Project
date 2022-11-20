<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $posts = Post::orderBy('id','DESC')->get();
        return view('backend.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('backend.post.create',compact('categories','tags'));
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
            'title'         => 'required',
            'category_id'   => 'required',
            'tag_id'        => 'required',
            'image'         => 'required',
            'description'   => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        $imageName = '';
        if(isset($image)){

            //make unique name for image`
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(400,400)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }
        Post::create([
            'title'         => $request->title,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'image'         => $imageName,
            'status'        => $request->filled('status'),
        ])->tags()->sync($request->tag_id);

        notify()->success('Post Created Successfully');
        return redirect()->route('app.post.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('category','tags')->findOrfail($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrfail($id);
        $categories = Category::all();
        $tags       = Tag::all();
        return view('backend.post.create',compact('categories','tags','post'));
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
        $request->validate([
            'title'         => 'required',
            'category_id'   => 'required',
            'tag_id'        => 'required',
            'description'   => 'required',
        ]);

        $post = Post::findOrfail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->title);
        $imageName = '';
        if(isset($image)){
            //make unique name for image`
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete old pic
            if(Storage::disk('public')->exists('post/'.$post->image)){

                Storage::disk('public')->delete('post/'.$post->image);
            }

            $postImage = Image::make($image)->resize(400,400)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName = $post->image;
        }

        $post->title        = $request->title;
        $post->category_id  = $request->category_id;
        $post->description  = $request->description;
        $post->image        = $imageName;
        $post->status       = $request->filled('status');
        $post->save();
        $post->tags()->sync($request->tag_id);

        notify()->success('Post Updated Successfully');
        return redirect()->route('app.post.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);

        //delete old pic
        if(Storage::disk('public')->exists('post/'.$post->image)){

            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->delete();

        notify()->success('Post Deleted Successfully');
        return redirect()->route('app.post.post.index');
    }
}
