<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'campus',
        'category',
        'date_lost_found',
        'location_area',
        'image',
        'status',
        'views'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date_lost_found' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the upvotes for the post.
     */
    public function upvotes()
    {
        return $this->hasMany(Upvote::class);
    }

    /**
     * Scope a query to only include active posts.
     * Used in HomeController: Post::active()
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include resolved posts.
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }
}