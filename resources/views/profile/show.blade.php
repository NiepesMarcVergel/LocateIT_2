{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', $user->name . ' - Profile')

@section('content')
<style>
    .profile-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .profile-header {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
        display: flex;
        gap: 2rem;
        align-items: start;
    }

    .profile-picture-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #9E1B1E;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-weight: bold;
        border: 4px solid #F7F7F7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .profile-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        color: #666;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: #9E1B1E;
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        padding: 1.5rem;
        background: #F7F7F7;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #9E1B1E;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
    }

    .btn-edit-profile,
    .btn-message-user {
        padding: 0.75rem 2rem;
        background: #9E1B1E;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit-profile:hover,
    .btn-message-user:hover {
        background: #7d1519;
        transform: translateY(-2px);
        color: white;
    }

    .privacy-notice {
        background: #FFF5F5;
        border: 2px solid #FFE5E5;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #9E1B1E;
    }

    .tabs-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }

    .tabs {
        display: flex;
        gap: 1rem;
        border-bottom: 2px solid #F7F7F7;
        overflow-x: auto;
    }

    .tab {
        padding: 1rem 1.5rem;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tab:hover,
    .tab.active {
        color: #9E1B1E;
        border-bottom-color: #9E1B1E;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .content-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .section-title {
        margin-bottom: 1.5rem;
        color: #9E1B1E;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.5rem;
    }

    .posts-grid {
        display: grid;
        gap: 1.5rem;
    }

    .post-card-mini {
        background: white;
        border: 2px solid #F7F7F7;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .post-card-mini:hover {
        border-color: #9E1B1E;
        box-shadow: 0 4px 12px rgba(158, 27, 30, 0.1);
        transform: translateY(-2px);
    }

    .post-mini-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .post-badge {
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

    .badge-resolved {
        background: #E5E5E5;
        color: #666;
    }

    .post-time {
        font-size: 0.85rem;
        color: #999;
    }

    .post-mini-title {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .post-mini-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .post-mini-meta i {
        color: #9E1B1E;
    }

    .post-mini-actions {
        display: flex;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #F7F7F7;
    }

    .mini-action-btn {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        color: #666;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: #9E1B1E;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 0 1rem;
        }

        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-stats {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

<div class="profile-container">
    <!-- Privacy Notice (only for public view) -->
    @if(Auth::id() !== $user->id)
        <div class="privacy-notice">
            <i class="fas fa-info-circle"></i>
            <span>You are viewing {{ $user->name }}'s public profile. Contact information is hidden for privacy.</span>
        </div>
    @endif

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-picture-section">
            <div class="profile-picture">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                @else
                    {{ $user->initials }}
                @endif
            </div>
        </div>
        
        <div class="profile-info">
            <h1 class="profile-name">{{ $user->name }}</h1>
            
            <div class="profile-meta">
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    <span>{{ $user->campus }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>Joined {{ $user->created_at->format('F Y') }}</span>
                </div>
                @if(Auth::id() === $user->id)
                    <div class="meta-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $user->contact_number }}</span>
                    </div>
                @endif
            </div>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $user->posts()->count() }}</div>
                    <div class="stat-label">Posts</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $user->posts()->where('status', 'resolved')->count() }}</div>
                    <div class="stat-label">Resolved</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $user->upvotes()->count() }}</div>
                    <div class="stat-label">Upvotes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $user->comments()->count() }}</div>
                    <div class="stat-label">Comments</div>
                </div>
            </div>
            
            @if(Auth::id() === $user->id)
                <button class="btn-edit-profile" onclick="document.getElementById('settings-tab').click()">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            @else
                <button class="btn-message-user">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            @endif
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs-container">
        <div class="tabs">
            <button class="tab active" onclick="switchTab('posts')">
                <i class="fas fa-file-lines"></i> Posts
            </button>
            <button class="tab" onclick="switchTab('resolved')">
                <i class="fas fa-check-circle"></i> Resolved Items
            </button>
            
            @if(Auth::id() === $user->id)
                <button class="tab" onclick="switchTab('upvoted')">
                    <i class="fas fa-thumbs-up"></i> Upvoted Posts
                </button>
                <button class="tab" onclick="switchTab('comments')">
                    <i class="fas fa-comments"></i> My Comments
                </button>
                <button class="tab" id="settings-tab" onclick="switchTab('settings')">
                    <i class="fas fa-gear"></i> Settings
                </button>
            @endif
        </div>
    </div>

    <!-- Posts Tab -->
    <div id="posts-content" class="tab-content active">
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-file-lines"></i> 
                @if(Auth::id() === $user->id)
                    My Posts
                @else
                    {{ $user->name }}'s Posts
                @endif
            </h2>
            
            <div class="posts-grid">
                @forelse($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="post-card-mini">
                        <div class="post-mini-header">
                            <span class="post-badge badge-{{ $post->type }}">
                                {{ strtoupper($post->type) }}
                            </span>
                            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="post-mini-title">{{ $post->title }}</h3>
                        <div class="post-mini-meta">
                            <span><i class="fas fa-building"></i> {{ $post->campus }}</span>
                            <span><i class="fas fa-calendar"></i> {{ $post->date_lost_found->format('M d, Y') }}</span>
                        </div>
                        <div class="post-mini-actions">
                            <span class="mini-action-btn">
                                <i class="fas fa-arrow-up"></i> {{ $post->upvotes()->count() }}
                            </span>
                            <span class="mini-action-btn">
                                <i class="fas fa-comment"></i> {{ $post->comments()->count() }}
                            </span>
                            <span class="mini-action-btn">
                                <i class="fas fa-eye"></i> {{ $post->views }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No posts yet</h3>
                        <p>
                            @if(Auth::id() === $user->id)
                                You haven't created any posts yet.
                            @else
                                This user hasn't created any posts yet.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Resolved Items Tab -->
    <div id="resolved-content" class="tab-content">
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-check-circle"></i> Resolved Items
            </h2>
            
            <div class="posts-grid">
                @forelse($resolvedPosts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="post-card-mini">
                        <div class="post-mini-header">
                            <span class="post-badge badge-resolved">RESOLVED</span>
                            <span style="font-size: 0.85rem; color: #2D7A2D; font-weight: 600;">
                                <i class="fas fa-check"></i> Successfully Recovered
                            </span>
                        </div>
                        <h3 class="post-mini-title">{{ $post->title }}</h3>
                        <div class="post-mini-meta">
                            <span><i class="fas fa-building"></i> {{ $post->campus }}</span>
                            <span><i class="fas fa-calendar"></i> {{ $post->date_lost_found->format('M d, Y') }}</span>
                        </div>
                        <div style="margin-top: 1rem; padding: 0.75rem; background: #E5F5E5; border-radius: 8px; color: #2D7A2D; font-size: 0.9rem;">
                            <i class="fas fa-info-circle"></i> 
                            Marked as resolved {{ $post->updated_at->diffForHumans() }}
                        </div>
                    </a>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h3>No resolved items</h3>
                        <p>No items have been marked as resolved yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if(Auth::id() === $user->id)
        <!-- Upvoted Posts Tab -->
        <div id="upvoted-content" class="tab-content">
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-thumbs-up"></i> Upvoted Posts
                </h2>
                
                <div class="posts-grid">
                    @forelse($upvotedPosts as $post)
                        <a href="{{ route('posts.show', $post) }}" class="post-card-mini">
                            <div class="post-mini-header">
                                <span class="post-badge badge-{{ $post->type }}">
                                    {{ strtoupper($post->type) }}
                                </span>
                                <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="post-mini-title">{{ $post->title }}</h3>
                            <div class="post-mini-meta">
                                <span><i class="fas fa-building"></i> {{ $post->campus }}</span>
                                <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                            </div>
                            <div class="post-mini-actions">
                                <span class="mini-action-btn" style="color: #9E1B1E; font-weight: 600;">
                                    <i class="fas fa-arrow-up"></i> {{ $post->upvotes()->count() }}
                                </span>
                                <span class="mini-action-btn">
                                    <i class="fas fa-comment"></i> {{ $post->comments()->count() }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-thumbs-up"></i>
                            <h3>No upvoted posts</h3>
                            <p>You haven't upvoted any posts yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- My Comments Tab -->
        <div id="comments-content" class="tab-content">
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-comments"></i> My Comments
                </h2>
                
                <div class="posts-grid">
                    @forelse($userComments as $comment)
                        <div class="post-card-mini">
                            <div style="margin-bottom: 1rem;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                                    Commented on <strong>{{ $comment->post->title }}</strong> by {{ $comment->post->user->name }}
                                </div>
                                <div style="padding: 1rem; background: #F7F7F7; border-radius: 8px; border-left: 4px solid #9E1B1E;">
                                    {{ $comment->comment_text }}
                                </div>
                            </div>
                            <div class="post-mini-meta">
                                <span><i class="fas fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ route('posts.show', $comment->post) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #9E1B1E; font-weight: 600; font-size: 0.9rem; margin-top: 0.75rem; text-decoration: none;">
                                View Post <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-comments"></i>
                            <h3>No comments yet</h3>
                            <p>You haven't commented on any posts yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Settings Tab -->
        <div id="settings-content" class="tab-content">
            <div class="content-section">
                <div style="max-width: 600px;">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #F7F7F7;">
                            <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.2rem;">
                                <i class="fas fa-user"></i> Personal Information
                            </h3>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Full Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Username</label>
                                <input type="text" name="username" value="{{ $user->username }}" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Contact Number</label>
                                <input type="tel" name="contact_number" value="{{ $user->contact_number }}" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Campus</label>
                                <select name="campus" style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                                    <option value="Alangilan Campus" {{ $user->campus == 'Alangilan Campus' ? 'selected' : '' }}>Alangilan Campus</option>
                                    <option value="Pablo Borbon Campus" {{ $user->campus == 'Pablo Borbon Campus' ? 'selected' : '' }}>Pablo Borbon Campus</option>
                                    <option value="Lipa Campus" {{ $user->campus == 'Lipa Campus' ? 'selected' : '' }}>Lipa Campus</option>
                                    <option value="Nasugbu Campus" {{ $user->campus == 'Nasugbu Campus' ? 'selected' : '' }}>Nasugbu Campus</option>
                                    <option value="Malvar Campus" {{ $user->campus == 'Malvar Campus' ? 'selected' : '' }}>Malvar Campus</option>
                                    <option value="Lemery Campus" {{ $user->campus == 'Lemery Campus' ? 'selected' : '' }}>Lemery Campus</option>
                                    <option value="Balayan Campus" {{ $user->campus == 'Balayan Campus' ? 'selected' : '' }}>Balayan Campus</option>
                                    <option value="San Juan Campus" {{ $user->campus == 'San Juan Campus' ? 'selected' : '' }}>San Juan Campus</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn-save" style="padding: 0.75rem 2rem; background: #9E1B1E; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                    
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #F7F7F7;">
                            <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.2rem;">
                                <i class="fas fa-lock"></i> Change Password
                            </h3>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Current Password</label>
                                <input type="password" name="current_password" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">New Password</label>
                                <input type="password" name="password" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Confirm New Password</label>
                                <input type="password" name="password_confirmation" 
                                       style="width: 100%; padding: 0.75rem; border: 2px solid #E5E5E5; border-radius: 8px;" required>
                            </div>
                            
                            <button type="submit" class="btn-save" style="padding: 0.75rem 2rem; background: #9E1B1E; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">
                                <i class="fas fa-key"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        event.target.classList.add('active');
        document.getElementById(tabName + '-content').classList.add('active');
    }
</script>
@endpush
@endsection