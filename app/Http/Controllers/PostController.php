<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Upvote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'campus' => 'required|string',
            'category' => 'required|string',
            'location_area' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Add user_id to the data
        $data = $validated;
        $data['user_id'] = Auth::id();
        $data['status'] = 'active';

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        $post = Post::create($data);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        // Increment view count
        $post->increment('views');

        // Load relationships needed for the view
        $post->load(['user', 'comments.user', 'upvotes']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        // Authorization: Ensure user owns the post
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:lost,found',
            'date_lost_found' => 'required|date|before_or_equal:today',
            'campus' => 'required|string',
            'category' => 'required|string',
            'location_area' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

    /**
     * Mark the post as resolved.
     */
    public function resolve(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $post->update(['status' => 'resolved']);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle upvote for a post.
     */
    public function toggleUpvote(Post $post)
    {
        $user = Auth::user();
        
        // Check if already upvoted
        $existingUpvote = Upvote::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingUpvote) {
            // Remove upvote
            $existingUpvote->delete();
            $upvoted = false;
        } else {
            // Add upvote
            Upvote::create([
                'post_id' => $post->id,
                'user_id' => $user->id
            ]);
            $upvoted = true;
        }

        return response()->json([
            'success' => true,
            'upvoted' => $upvoted,
            'count' => $post->upvotes()->count()
        ]);
    }
}