<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store new comment
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'comment_text' => $validated['comment_text'],
        ]);

        // Load user relationship
        $comment->load('user');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment,
                'html' => view('partials.comment', compact('comment'))->render()
            ]);
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    /**
     * Delete comment
     */
    public function destroy(Comment $comment)
    {
        // Check if user owns the comment or the post
        if ($comment->user_id !== Auth::id() && $comment->post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $postId = $comment->post_id;
        $comment->delete();

        return redirect()
            ->route('posts.show', $postId)
            ->with('success', 'Comment deleted successfully!');
    }
}