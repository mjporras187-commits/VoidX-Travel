<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Only show the logged-in user's posts
        $posts = Post::where('user_id', Auth::id())
                     ->latest()
                     ->get();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        // Make sure only the owner can update
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        // Make sure only the owner can delete
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully!');
    }
}