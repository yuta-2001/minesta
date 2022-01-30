<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::withCount('likes')->orderBy('created_at', 'desc')->get();

        $like_model = new Like();

        return view('user.index', compact('posts', 'like_model'));
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_location' => 'max:30|nullable',
            'post_photo' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|required',
            'caption' => 'max:500|nullable',
        ]);

        $filename = $request->post_photo->getClientOriginalName();

        $img = $request->post_photo->storeAs('image/posts', $filename, 'public');

        $post = new Post();

        // $post->user_id = Auth::id();
        // $post->location = $request->location;
        // $post->post_photo = $request->post_photo;
        // $post->fish_name = $request->fish_name;
        // $post->fish_count = $request->fish_count;
        // $post->caption = $request->caption;

        $post->create([
            'user_id' => Auth::id(),
            'location' => $request->location,
            'post_photo' => $filename,
            'caption' => $request->caption
        ]); 


        return redirect()->route('posts.index')
                ->with(['message' => '投稿を作成しました',
                'status' => 'info']);
    }

    
    public function edit($id)
    {
        $post = Post::find($id);

        if(!(Auth::id() === $post->user_id)){
            return \App::abort(404);
        }

        return view('user.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'post_location' => 'max:30|nullable',
            'post_photo' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
            'caption' => 'max:500|nullable',
        ]);

        $post = Post::find($id);

        if(!(Auth::id() === $post->user_id)){
            return \App::abort(404);
        }

        $post->location = $request->location;
        if(isset($request->post_photo)){
            $filename = $request->post_photo->getClientOriginalName();
            $img = $request->post_photo->storeAs('image/posts', $filename, 'public');

            Storage::delete('public/image/posts/' . $post->post_photo);

            $post->post_photo = $filename;
        }
        $post->caption = $request->caption;


        // dd($post);

        $post->save();

        // dd($post);

        return redirect()->route('posts.index')
                ->with(['message' => '投稿を編集しました',
                'status' => 'info']);;
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if(!(Auth::id() === $post->user_id)){
            return \App::abort(404);
        }

        Storage::delete('public/image/posts/' . $post->post_photo);

        $post->delete();

        return redirect()->route('posts.index')
               ->with(['message' => '投稿を削除しました',
                'status' => 'alert']);
    }
}
