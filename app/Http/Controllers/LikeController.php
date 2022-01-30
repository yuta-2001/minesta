<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    
    // public function store($id)
    // {
    //     $like = new Like();

    //     $like->create([
    //         'user_id' => Auth::id(),
    //         'post_id' => $id,
    //     ]); 

    //     return redirect()->back();

    // }

    // public function destroy($id)
    // {

    //     $like = Like::where('user_id', Auth::id())->where('post_id', $id);

    //     $like->delete();

    //     return redirect()->back();
    // }

    public function ajaxlike(Request $request)
    {

        // dd($request);

        $id = Auth::id();
        $post_id = $request->post_id;
        $like = new Like();
        $post = Post::findOrFail($post_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::id();
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

}
