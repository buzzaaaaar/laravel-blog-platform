<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggle(BlogPost $post)
    {
        $user = Auth::user();
        if ($user->bookmarkedPosts()->where('blog_post_id', $post->id)->exists()) {
            $user->bookmarkedPosts()->detach($post->id);
            return back()->with('success', 'Removed from bookmarks.');
        } else {
            $user->bookmarkedPosts()->attach($post->id);
            return back()->with('success', 'Added to bookmarks.');
        }
    }

    public function index()
    {
        $bookmarkedPosts = Auth::user()->bookmarkedPosts()->paginate(10);
        return view('bookmarks.index', compact('bookmarkedPosts'));
    }
}
