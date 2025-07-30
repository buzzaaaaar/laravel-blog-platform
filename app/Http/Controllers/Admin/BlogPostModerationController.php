<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostModerationController extends Controller
{
    public function index()
    {
        // Show posts pending approval or all posts (based on your logic)
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    // Optional: show post details if needed
    public function show(BlogPost $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    // Delete a post
    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }

    // Custom action to approve a post
    public function approve(BlogPost $post)
    {
        $post->update(['is_approved' => true]);  // You'll need to add this column in the DB

        return redirect()->route('admin.posts.index')->with('success', 'Post approved.');
    }

    // Custom action to reject a post
    public function reject(BlogPost $post)
    {
        $post->update(['is_approved' => false]);

        return redirect()->route('admin.posts.index')->with('success', 'Post rejected.');
    }
}
