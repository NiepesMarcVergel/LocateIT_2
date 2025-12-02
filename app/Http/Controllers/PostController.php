<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Upvote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // ... [create, store, show, edit methods remain the same] ...

    public function create()
    {
        return view('posts.create');
    }

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

        $data = $validated;
        $data['user_id'] = Auth::id();
        $data['status'] = 'active';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        Post::create($data);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->increment('views');
        $post->load(['user', 'comments.user', 'upvotes']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
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

        // FIX: Start with validated data but remove 'image' key initially 
        // to prevent overwriting with null if no file is uploaded.
        $data = collect($validated)->except(['image'])->toArray();

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

    // ... [destroy, resolve, toggleUpvote methods remain the same] ...
    
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

    public function resolve(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $post->update(['status' => 'resolved']);

        return response()->json(['success' => true]);
    }

    public function toggleUpvote(Post $post)
    {
        $user = Auth::user();
        
        $existingUpvote = Upvote::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingUpvote) {
            $existingUpvote->delete();
            $upvoted = false;
        } else {
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