<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(User $user)
    {
        // Get user's active posts
        $posts = $user->posts()
            ->active()
            ->with(['user', 'upvotes', 'comments'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user's resolved posts
        $resolvedPosts = $user->posts()
            ->resolved()
            ->with(['user', 'upvotes', 'comments'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get posts the user has upvoted
        $upvotedPosts = $user->upvotes()
            ->with(['post.user', 'post.upvotes', 'post.comments'])
            ->latest()
            ->get()
            ->pluck('post')
            ->filter();

        // Get comments made by the user
        $userComments = $user->comments()
            ->with('post.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.show', compact('user', 'posts', 'resolvedPosts', 'upvotedPosts', 'userComments'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        return redirect()->route('profile.show', Auth::id());
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'contact_number' => ['required', 'string', 'max:20'],
            'campus' => ['required', 'string'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('profile.show', $user->id)
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.show', $user->id)
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        Auth::logout();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}