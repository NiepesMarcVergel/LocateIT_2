<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * * IMPORTANT: All your custom fields MUST be listed here.
     */
    protected $fillable = [
        'name',
        'username',       // <--- Ensure this is added
        'email',
        'password',
        'campus',         // <--- Ensure this is added
        'contact_number', // <--- Ensure this is added
        'profile_photo',  // <--- Ensure this is added
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ... Relationships ...

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function upvotes()
    {
        return $this->hasMany(Upvote::class);
    }

    public function hasUpvoted($postId)
    {
        return $this->upvotes()->where('post_id', $postId)->exists();
    }

    protected function initials(): Attribute
    {
        return Attribute::make(
            get: function () {
                $names = explode(' ', $this->name);
                $initials = '';
                if (isset($names[0])) {
                    $initials .= strtoupper(substr($names[0], 0, 1));
                }
                if (count($names) > 1) {
                    $initials .= strtoupper(substr(end($names), 0, 1));
                }
                return $initials ?: strtoupper(substr($this->name, 0, 2));
            }
        );
    }
}