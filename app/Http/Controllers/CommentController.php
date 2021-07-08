<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $id)
    {
        $comment = new Comment();
        $comment->topic_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->comment;

        if ($comment->save()) {
            return back()
                ->with('success', 'Successfully commented on this topic!');
        }

        return back()
            ->with('success', 'There was a problem with your comment, please try again.');
    }
}
