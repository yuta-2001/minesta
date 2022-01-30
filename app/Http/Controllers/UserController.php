<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $posts = Post::withCount('likes')->where('user_id', $id)->orderBy('created_at', 'desc')->get();

        $like_model = new Like();

        $user = User::find($id);

        return view('user.profile', compact('posts', 'user', 'like_model'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if(!(Auth::id() === $user->id)){
            return \App::abort(404);
        }

        return view('user.profile_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'post_location' => 'max:30|nullable',
        //     'post_photo' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
        //     'fish_name' => 'max:30|nullable',
        //     'fish_count' => 'integer|nullable',
        //     'caption' => 'max:500|nullable',
        // ]);

        $user = User::find($id);

        if(!(Auth::id() === $user->id)){
            return \App::abort(404);
        }

        $user->name = $request->name;
        if(isset($request->profile_photo)){
            $filename = $request->profile_photo->getClientOriginalName();
            $img = $request->profile_photo->storeAs('image/users', $filename, 'public');

            $user->profile_photo = $filename;
        }
        $user->profile_comment = $request->profile_comment;

        // dd($post);

        $user->save();

        // dd($post);

        return redirect()->route('users.show', ['user' => $user->id]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(!(Auth::id() === $user->id)){
            return \App::abort(404);
        }

        Storage::delete('public/image/posts/' . $user->profile_photo);

        $user->delete();

        return redirect()->route('dashboard');
    }
}
