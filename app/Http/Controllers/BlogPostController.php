<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;


class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::with('category', 'tags', 'author')
            ->where('is_approved', true);

        // Search by title or content
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by multiple categories
        if ($categories = $request->input('category')) {
            if (is_array($categories)) {
                $query->whereIn('category_id', $categories);
            } else {
                $query->where('category_id', $categories);
            }
        }

        // Filter by multiple authors
        if ($authors = $request->input('author')) {
            if (is_array($authors)) {
                $query->whereIn('user_id', $authors);
            } else {
                $query->where('user_id', $authors);
            }
        }

        // Filter by multiple tags
        if ($tags = $request->input('tag')) {
            if (is_array($tags)) {
                $query->whereHas('tags', function ($q) use ($tags) {
                    $q->whereIn('tags.id', $tags);
                });
            } else {
                $query->whereHas('tags', function ($q) use ($tags) {
                    $q->where('tags.id', $tags);
                });
            }
        }

        // Filter by saved (bookmarked) posts
        if ($request->input('saved') && auth()->check()) {
            $savedPostIds = auth()->user()->bookmarkedPosts()->pluck('blog_post_id');
            $query->whereIn('id', $savedPostIds);
        }

        $posts = $query->paginate(10)->appends(request()->query());

        // For filters dropdowns
        $categories = Category::all();
        $tags = Tag::all();
        $authors = User::all();

        return view('blog_posts.index', compact('posts', 'categories', 'tags', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blog_posts.create', compact('categories', 'tags'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = \Str::slug($request->title);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        $post = BlogPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->input('content'),
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach();
        }


        return redirect()->route('blog-posts.index')->with('success', 'Blog post created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = BlogPost::with('author', 'category', 'tags', 'comments.user', 'likes')
            ->where('slug', $slug)
            ->firstOrFail();

        $editingCommentId = request('edit');

        $user = auth()->user();
        $hasBookmarked = false;

        if ($user) {
            $hasBookmarked = $user->bookmarkedPosts()->where('blog_post_id', $post->id)->exists();
        }

        // ✅ SEO metadata setup
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription(substr(strip_tags($post->content), 0, 160));
        SEOMeta::addKeyword($post->tags->pluck('name')->toArray());

        OpenGraph::setTitle($post->title)
            ->setDescription(substr(strip_tags($post->content), 0, 160))
            ->setUrl(url()->current())
            ->addImage(asset('storage/images/' . $post->image));

        TwitterCard::setTitle($post->title)
            ->setDescription(substr(strip_tags($post->content), 0, 160))
            ->setImage(asset('storage/images/' . $post->image));

        return view('blog_posts.show', compact('post', 'editingCommentId', 'hasBookmarked'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = Category::all();
        $tags = Tag::all();

        // Load tags ids to pre-check them in form
        $selectedTags = $blogPost->tags->pluck('id')->toArray();

        return view('blog_posts.edit', compact('blogPost', 'categories', 'tags', 'selectedTags'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = \Str::slug($request->input('title'));

        if ($request->hasFile('image')) {
            // Optionally delete old image here if exists
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blogPost->image = $imagePath;
        }

        $blogPost->title = $request->input('title');
        $blogPost->slug = $slug;
        $blogPost->content = $request->input('content');
        $blogPost->category_id = $request->input('category_id');

        $blogPost->save();

        if ($request->has('tags')) {
            $blogPost->tags()->sync($request->input('tags'));
        } else {
            $blogPost->tags()->detach();
        }

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->tags()->detach();

        // Optionally delete image file here if stored

        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }

    public function like(BlogPost $post)
    {
        $user = Auth::user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->detach($user->id);
        } else {
            $post->likes()->attach($user->id);
        }

        return redirect()->back();
    }
}
