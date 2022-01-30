<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
      // dd($request);

      $comment = new Comment();

      $comment->create([
        'user_id' => Auth::id(),
        'post_id' => $id,
        'content' => $request->content,
      ]);

      return redirect()->back()
              ->with(['message' => 'コメントを投稿しました',
              'status' => 'info']);;
    }

    public function destroy($id)
    {
      $comment = Comment::where('id', $id);

      $comment->delete();

      return redirect()->back()
              ->with(['message' => 'コメントを削除しました',
              'status' => 'alert']);
    }
}
