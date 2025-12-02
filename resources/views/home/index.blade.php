{{-- resources/views/home/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Home Feed - LocateIT')

@section('content')
<style>
    .main-container {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 1fr 2.5fr;
        gap: 2rem;
    }

    .sidebar {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        height: fit-content;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: sticky;
        top: 90px;
    }

    .sidebar h3 {
        color: #9E1B1E;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .filter-group {
        margin-bottom: 1.5rem;
    }

    .filter-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
        font-size: 0.9rem;
    }

    select, input[type="date"] {
        width: 100%;
        padding: 0.6rem;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.3s;
    }

    select:focus, input[type="date"]:focus {
        outline: none;
        border-color: #9E1B1E;
    }

    .filter-chip {
        padding: 0.6rem 1rem;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
        text-decoration: none;
        color: #333;
    }

    .filter-chip:hover, .filter-chip.active {
        border-color: #9E1B1E;
        background: #FFF5F5;
        color: #9E1B1E;
    }

    .feed-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .search-bar {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .search-input-container {
        display: flex;
        gap: 1rem;
    }

    .search-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 1rem;
    }

    .search-input:focus {
        outline: none;
        border-color: #9E1B1E;
    }

    .btn-search {
        padding: 0.75rem 2rem;
        background: #9E1B1E;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-search:hover {
        background: #7d1519;
        transform: translateY(-2px);
    }

    .feed-tabs {
        display: flex;
        gap: 1rem;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .feed-tab {
        padding: 0.6rem 1.5rem;
        border: 2px solid transparent;
        background: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .feed-tab:hover, .feed-tab.active {
        color: #9E1B1E;
        background: #FFF5F5;
        border-color: #9E1B1E;
    }

    .post-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 2px solid transparent;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .post-card:hover {
        border-color: #9E1B1E;
        box-shadow: 0 4px 16px rgba(158, 27, 30, 0.1);
        transform: translateY(-2px);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .post-author {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .author-pic {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #9E1B1E;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        overflow: hidden;
    }

    .author-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h4 {
        color: #333;
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }

    .post-meta {
        font-size: 0.85rem;
        color: #666;
    }

    .post-type-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-lost {
        background: #FFE5E5;
        color: #9E1B1E;
    }

    .badge-found {
        background: #E5F5E5;
        color: #2D7A2D;
    }

    .post-content {
        margin-bottom: 1rem;
    }

    .post-title {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .post-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }

    .post-details {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .post-detail-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .post-detail-item i {
        color: #9E1B1E;
    }

    .post-actions {
        display: flex;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #F7F7F7;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1rem;
        border: none;
        background: #F7F7F7;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.95rem;
        color: #666;
    }

    .action-btn:hover {
        background: #9E1B1E;
        color: white;
    }

    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 60px;
        height: 60px;
        background: #9E1B1E;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(158, 27, 30, 0.4);
        transition: all 0.3s;
        z-index: 50;
        text-decoration: none;
    }

    .fab:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 6px 20px rgba(158, 27, 30, 0.5);
    }

    @media (max-width: 1024px) {
        .main-container {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: relative;
            top: 0;
        }
    }
</style>

<div class="main-container">
    <!-- Sidebar Filters -->
    <aside class="sidebar">
        <h3><i class="fas fa-filter"></i> Filters</h3>
        
        <form action="{{ route('home') }}" method="GET">
            <div class="filter-group">
                <label>Campus</label>
                <select name="campus" onchange="this.form.submit()">
                    <option value="">All Campuses</option>
                    <option value="Alangilan Campus" {{ request('campus') == 'Alangilan Campus' ? 'selected' : '' }}>Alangilan Campus</option>
                    <option value="Pablo Borbon Campus" {{ request('campus') == 'Pablo Borbon Campus' ? 'selected' : '' }}>Pablo Borbon Campus</option>
                    <option value="Lipa Campus" {{ request('campus') == 'Lipa Campus' ? 'selected' : '' }}>Lipa Campus</option>
                    <option value="Nasugbu Campus" {{ request('campus') == 'Nasugbu Campus' ? 'selected' : '' }}>Nasugbu Campus</option>
                    <option value="Malvar Campus" {{ request('campus') == 'Malvar Campus' ? 'selected' : '' }}>Malvar Campus</option>
                    <option value="Lemery Campus" {{ request('campus') == 'Lemery Campus' ? 'selected' : '' }}>Lemery Campus</option>
                    <option value="Balayan Campus" {{ request('campus') == 'Balayan Campus' ? 'selected' : '' }}>Balayan Campus</option>
                    <option value="San Juan Campus" {{ request('campus') == 'San Juan Campus' ? 'selected' : '' }}>San Juan Campus</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Category</label>
                <select name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <option value="ID / Documents" {{ request('category') == 'ID / Documents' ? 'selected' : '' }}>ID / Documents</option>
                    <option value="Gadgets" {{ request('category') == 'Gadgets' ? 'selected' : '' }}>Gadgets</option>
                    <option value="Clothing" {{ request('category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                    <option value="Bags" {{ request('category') == 'Bags' ? 'selected' : '' }}>Bags</option>
                    <option value="Accessories" {{ request('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                    <option value="Books" {{ request('category') == 'Books' ? 'selected' : '' }}>Books</option>
                    <option value="Others" {{ request('category') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Sort By</label>
                <a href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" 
                   class="filter-chip {{ request('sort') == 'newest' || !request('sort') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i> Newest
                </a>
                <a href="{{ route('home', array_merge(request()->except('sort'), ['sort' => 'upvoted'])) }}" 
                   class="filter-chip {{ request('sort') == 'upvoted' ? 'active' : '' }}">
                    <i class="fas fa-arrow-up"></i> Most Upvoted
                </a>
            </div>
        </form>
    </aside>

    <!-- Main Feed -->
    <main class="feed-section">
        <!-- Search Bar -->
        <div class="search-bar">
            <form action="{{ route('home') }}" method="GET">
                <div class="search-input-container">
                    <input type="text" name="search" class="search-input" 
                           placeholder="Search for items by name, description, location..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Feed Tabs -->
        <div class="feed-tabs">
            <a href="{{ route('home') }}" class="feed-tab {{ !request('type') ? 'active' : '' }}">
                <i class="fas fa-star"></i> All Posts
            </a>
            <a href="{{ route('home', ['type' => 'lost']) }}" class="feed-tab {{ request('type') == 'lost' ? 'active' : '' }}">
                <i class="fas fa-magnifying-glass"></i> Lost Items
            </a>
            <a href="{{ route('home', ['type' => 'found']) }}" class="feed-tab {{ request('type') == 'found' ? 'active' : '' }}">
                <i class="fas fa-hand-holding"></i> Found Items
            </a>
        </div>

        <!-- Post Cards -->
        @forelse($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="post-card">
                <div class="post-header">
                    <div class="post-author">
                        <div class="author-pic">
                            @if($post->user->profile_photo)
                                <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="{{ $post->user->name }}">
                            @else
                                {{ $post->user->initials }}
                            @endif
                        </div>
                        <div class="author-info">
                            <h4>{{ $post->user->name }}</h4>
                            <div class="post-meta">
                                <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <span class="post-type-badge badge-{{ $post->type }}">
                        {{ strtoupper($post->type) }}
                    </span>
                </div>
                
                <div class="post-content">
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <p class="post-description">{{ Str::limit($post->description, 150) }}</p>
                    <div class="post-details">
                        <div class="post-detail-item">
                            <i class="fas fa-building"></i> {{ $post->campus }}
                        </div>
                        <div class="post-detail-item">
                            <i class="fas fa-calendar"></i> {{ $post->date_lost_found->format('M d, Y') }}
                        </div>
                        <div class="post-detail-item">
                            <i class="fas fa-tag"></i> {{ $post->category }}
                        </div>
                    </div>
                </div>
                
                <div class="post-actions">
                    <span class="action-btn">
                        <i class="fas fa-arrow-up"></i> {{ $post->upvotes->count() }}
                    </span>
                    <span class="action-btn">
                        <i class="fas fa-comment"></i> {{ $post->comments->count() }}
                    </span>
                    <span class="action-btn">
                        <i class="fas fa-eye"></i> {{ $post->views }}
                    </span>
                </div>
            </a>
        @empty
            <div style="text-align: center; padding: 3rem; background: white; border-radius: 12px;">
                <i class="fas fa-inbox" style="font-size: 4rem; color: #9E1B1E; opacity: 0.5; margin-bottom: 1rem;"></i>
                <h3 style="color: #333; margin-bottom: 0.5rem;">No posts found</h3>
                <p style="color: #666;">Try adjusting your filters or search terms.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div style="margin-top: 2rem;">
            {{ $posts->links() }}
        </div>
    </main>
</div>

<!-- Floating Action Button -->
<a href="{{ route('posts.create') }}" class="fab">
    <i class="fas fa-plus"></i>
</a>
@endsection