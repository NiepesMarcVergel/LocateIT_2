{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.app')

@section('title', $post->title . ' - LocateIT')

@section('content')
<style>
    .main-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .post-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .post-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .status-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .status-badge {
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-lost {
        background: #FFE5E5;
        color: #9E1B1E;
    }

    .badge-found {
        background: #E5F5E5;
        color: #2D7A2D;
    }

    .badge-resolved {
        background: #E5E5E5;
        color: #666;
    }

    .owner-actions {
        display: flex;
        gap: 0.75rem;
    }

    .action-btn-sm {
        padding: 0.5rem 1rem;
        border: 2px solid #E5E5E5;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        color: #666;
    }

    .action-btn-sm:hover {
        border-color: #9E1B1E;
        color: #9E1B1E;
    }

    .btn-delete:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #FFF5F5;
    }

    .btn-resolve {
        background: #2D7A2D;
        color: white;
        border-color: #2D7A2D;
    }

    .btn-resolve:hover {
        background: #246424;
        color: white;
    }

    .post-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .post-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 1rem;
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #F7F7F7;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        font-size: 0.95rem;
    }

    .meta-item i {
        color: #9E1B1E;
        font-size: 1.1rem;
    }

    .post-description {
        line-height: 1.8;
        color: #555;
        font-size: 1.05rem;
        margin-bottom: 1.5rem;
    }

    .author-section {
        background: #F7F7F7;
        padding: 1.5rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .author-pic-large {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #9E1B1E;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        overflow: hidden;
    }

    .author-pic-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h3 {
        color: #333;
        margin-bottom: 0.3rem;
        font-size: 1.1rem;
    }

    .author-info p {
        color: #666;
        font-size: 0.9rem;
    }

    .view-profile-btn {
        margin-left: auto;
        padding: 0.6rem 1.2rem;
        background: white;
        color: #9E1B1E;
        border: 2px solid #9E1B1E;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-weight: 600;
    }

    .view-profile-btn:hover {
        background: #9E1B1E;
        color: white;
    }

    .engagement-section {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 2px solid #F7F7F7;
    }

    .engagement-btn {
        flex: 1;
        padding: 0.75rem;
        border: 2px solid #E5E5E5;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: #666;
    }

    .engagement-btn:hover,
    .engagement-btn.active {
        background: #9E1B1E;
        color: white;
        border-color: #9E1B1E;
    }

    .comments-section {
        margin-top: 2rem;
    }

    .comments-header {
        margin-bottom: 1.5rem;
    }

    .comments-header h3 {
        font-size: 1.3rem;
        color: #333;
    }

    .comment-input-container {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #9E1B1E;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
        overflow: hidden;
    }

    .comment-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .comment-input-wrapper {
        flex: 1;
    }

    .comment-input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        resize: vertical;
        min-height: 60px;
    }

    .comment-input:focus {
        outline: none;
        border-color: #9E1B1E;
    }

    .btn-comment {
        margin-top: 0.75rem;
        padding: 0.6rem 1.5rem;
        background: #9E1B1E;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-comment:hover {
        background: #7d1519;
    }

    .comment-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #F0F0F0;
    }

    .comment-item:last-child {
        border-bottom: none;
    }

    .comment-content {
        flex: 1;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .comment-author {
        font-weight: 600;
        color: #333;
    }

    .comment-time {
        font-size: 0.85rem;
        color: #999;
    }

    .comment-text {
        color: #555;
        line-height: 1.6;
        margin-bottom: 0.5rem;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .sidebar-card h3 {
        color: #9E1B1E;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .contact-info-item {
        display: flex;
        align-items: start;
        gap: 0.75rem;
        margin-bottom: 1rem;
        color: #555;
    }

    .contact-info-item:last-child {
        margin-bottom: 0;
    }

    .contact-info-item i {
        color: #9E1B1E;
        font-size: 1.1rem;
        margin-top: 0.2rem;
    }

    .btn-message {
        width: 100%;
        padding: 0.85rem;
        background: #9E1B1E;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        margin-top: 1rem;
    }

    .btn-message:hover {
        background: #7d1519;
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .main-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .main-container {
            padding: 0 1rem;
        }

        .post-card {
            padding: 1.5rem;
        }

        .post-title {
            font-size: 1.5rem;
        }

        .owner-actions {
            width: 100%;
        }

        .action-btn-sm {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="main-container">
    <!-- Main Post Content -->
    <div class="post-content">
        <div class="post-card">
            <!-- Status and Owner Actions -->
            <div class="status-header">
                <span class="status-badge badge-{{ $post->type }}">
                    <i class="fas fa-{{ $post->type == 'lost' ? 'magnifying-glass' : 'hand-holding' }}"></i> 
                    {{ strtoupper($post->type) }} ITEM
                </span>
                
                @if($post->user_id == Auth::id())
                    <div class="owner-actions">
                        <a href="{{ route('posts.edit', $post) }}" class="action-btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn-sm btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                        @if($post->status != 'resolved')
                            <button class="action-btn-sm btn-resolve" onclick="resolvePost()">
                                <i class="fas fa-check-circle"></i> Mark as Resolved
                            </button>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Image -->
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="post-image">
            @endif

            <!-- Post Title & Meta -->
            <h1 class="post-title">{{ $post->title }}</h1>
            
            <div class="post-meta">
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    <span>{{ $post->campus }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $post->date_lost_found->format('F d, Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-tag"></i>
                    <span>{{ $post->category }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>Posted {{ $post->created_at->diffForHumans() }}</span>
                </div>
                @if($post->location_area)
                    <div class="meta-item">
                        <i class="fas fa-location-dot"></i>
                        <span>{{ $post->location_area }}</span>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="post-description">
                {{ $post->description }}
            </div>

            <!-- Author Section -->
            <div class="author-section">
                <div class="author-pic-large">
                    @if($post->user->profile_photo)
                        <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="{{ $post->user->name }}">
                    @else
                        {{ $post->user->initials }}
                    @endif
                </div>
                <div class="author-info">
                    <h3>{{ $post->user->name }}</h3>
                    <p><i class="fas fa-building"></i> {{ $post->user->campus }}</p>
                </div>
                <a href="{{ route('profile.show', $post->user) }}" class="view-profile-btn">View Profile</a>
            </div>

            <!-- Engagement Actions -->
            <div class="engagement-section">
                <!-- Using quotes here '{{ $post->id }}' makes IDEs happier -->
                <button class="engagement-btn {{ Auth::user()->hasUpvoted($post->id) ? 'active' : '' }}" 
                        onclick="toggleUpvote('{{ $post->id }}')">
                    <i class="fas fa-arrow-up"></i>
                    <span id="upvote-count">{{ $post->upvotes->count() }}</span>
                </button>
                <button class="engagement-btn">
                    <i class="fas fa-comment"></i>
                    <span>{{ $post->comments->count() }} Comments</span>
                </button>
                <button class="engagement-btn">
                    <i class="fas fa-eye"></i>
                    <span>{{ $post->views }} Views</span>
                </button>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <div class="comments-header">
                    <h3>Comments</h3>
                </div>

                <!-- Comment Input -->
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="comment-input-container">
                        <div class="comment-avatar">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{ Auth::user()->initials }}
                            @endif
                        </div>
                        <div class="comment-input-wrapper">
                            <textarea name="comment_text" class="comment-input" 
                                      placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="btn-comment">
                                <i class="fas fa-paper-plane"></i> Post Comment
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Comments List -->
                @forelse($post->comments as $comment)
                    <div class="comment-item">
                        <div class="comment-avatar">
                            @if($comment->user->profile_photo)
                                <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="{{ $comment->user->name }}">
                            @else
                                {{ $comment->user->initials }}
                            @endif
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">{{ $comment->user->name }}</span>
                                <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="comment-text">{{ $comment->comment_text }}</p>
                            
                            @if($comment->user_id == Auth::id() || $post->user_id == Auth::id())
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 0.85rem;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #666; padding: 2rem;">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Contact Information -->
        <div class="sidebar-card">
            <h3><i class="fas fa-address-book"></i> Contact Information</h3>
            <div class="contact-info-item">
                <i class="fas fa-user"></i>
                <span>{{ $post->user->name }}</span>
            </div>
            <div class="contact-info-item">
                <i class="fas fa-envelope"></i>
                <span>{{ $post->user->email }}</span>
            </div>
            <div class="contact-info-item">
                <i class="fas fa-phone"></i>
                <span>{{ $post->user->contact_number }}</span>
            </div>
            <div class="contact-info-item">
                <i class="fas fa-building"></i>
                <span>{{ $post->user->campus }}</span>
            </div>
        </div>
    </aside>
</div>

@push('scripts')
<script>
    function toggleUpvote(postId) {
        // Ensure valid postId if quotes are used
        postId = String(postId).trim();
        
        fetch(`/posts/${postId}/upvote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('upvote-count').textContent = data.count;
                const btn = document.querySelector('.engagement-btn');
                if (data.upvoted) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function resolvePost() {
        if (!confirm('Are you sure you want to mark this post as resolved?')) {
            return;
        }

        fetch(`/posts/{{ $post->id }}/resolve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Post marked as resolved!');
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush
@endsection