<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display home feed with all posts
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'upvotes', 'comments'])
            ->active()
            ->orderBy('created_at', 'desc');

        // Filter by type (lost/found)
        if ($request->has('type') && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }

        // Filter by campus
        if ($request->has('campus') && !empty($request->campus)) {
            $query->where('campus', $request->campus);
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Sort by
        if ($request->has('sort')) {
            if ($request->sort === 'upvoted') {
                $query->withCount('upvotes')->orderBy('upvotes_count', 'desc');
            } elseif ($request->sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'ILIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'ILIKE', "%{$searchTerm}%")
                  ->orWhere('location_area', 'ILIKE', "%{$searchTerm}%");
            });
        }

        $posts = $query->paginate(10);

        return view('home.index', compact('posts'));
    }

    /**
     * Search posts
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}