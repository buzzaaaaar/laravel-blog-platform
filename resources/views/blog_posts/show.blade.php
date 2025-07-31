@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                <li><a href="{{ route('blog-posts.index') }}" class="transition-colors duration-200 hover:text-primary-600 dark:hover:text-primary-400">Blog Posts</a></li>
                <li><i class="text-xs fas fa-chevron-right"></i></li>
                <li class="text-gray-900 dark:text-white">{{ $post->title }}</li>
            </ol>
        </nav>

        <!-- Article Header -->
        <article class="mb-8 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <!-- Featured Image -->
            @if($post->image)
            <div class="overflow-hidden aspect-video">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                    class="object-cover w-full h-full">
            </div>
            @endif

            <!-- Article Content -->
            <div class="p-8">
                <!-- Title -->
                <h1 class="mb-4 text-4xl font-bold leading-tight text-gray-900 dark:text-white">{{ $post->title }}</h1>

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 mr-2 rounded-full bg-primary-100 dark:bg-primary-900">
                            <span class="text-sm font-semibold text-primary-600 dark:text-primary-400">
                                {{ substr($post->author->name ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        <span>{{ $post->author->name ?? 'Anonymous' }}</span>
                    </div>

                    <span class="flex items-center">
                        <i class="mr-1 fas fa-calendar"></i>
                        {{ $post->created_at->format('M d, Y') }}
                    </span>

                    @if($post->category)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200">
                        {{ $post->category->name }}
                    </span>
                    @endif
                </div>

                <!-- Tags -->
                @if($post->tags->count())
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($post->tags as $tag)
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                        #{{ $tag->name }}
                    </span>
                    @endforeach
                </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none dark:prose-invert prose-headings:text-gray-900 dark:prose-headings:text-white prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-a:text-primary-600 dark:prose-a:text-primary-400 prose-img:rounded-lg prose-img:shadow-md">
                    {!! $post->content !!}
                </div>
            </div>
        </article>

        <!-- Action Buttons -->
        <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <!-- Like Button -->
                    @auth
                    <form action="{{ route('blog.like', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <i class="fas fa-heart mr-2 {{ Auth::user()->likedPosts->contains($post->id) ? 'text-red-500' : '' }}"></i>
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </button>
                    </form>
                    @else
                    <div class="inline-flex items-center px-4 py-2 text-gray-500 border border-gray-300 rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <i class="mr-2 fas fa-heart"></i>
                        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                    </div>
                    @endauth

                    <!-- Bookmark Button -->
                    @auth
                    <form action="{{ route('bookmarks.toggle', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <i class="fas fa-bookmark mr-2 {{ $hasBookmarked ? 'text-primary-500' : '' }}"></i>
                            <span>{{ $hasBookmarked ? 'Saved' : 'Save for Later' }}</span>
                        </button>
                    </form>
                    @endauth
                </div>

                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <i class="mr-1 fas fa-comment"></i>
                        {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Comments</h2>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Join the conversation</p>
            </div>

            <!-- Comment Form -->
            @auth
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Add a comment</label>
                        <textarea name="content" id="content" rows="4"
                            class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg resize-none dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="Share your thoughts..." required></textarea>
                        @error('content')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                        <i class="mr-2 fas fa-paper-plane"></i>Post Comment
                    </button>
                </form>
            </div>
            @else
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="py-4 text-center">
                    <p class="mb-4 text-gray-600 dark:text-gray-400">Please <a href="{{ route('login') }}" class="font-medium text-primary-600 dark:text-primary-400 hover:underline">login</a> to comment.</p>
                </div>
            </div>
            @endauth

            <!-- Comments List -->
            <div class="p-6">
                @if($post->comments->count())
                <div class="space-y-6">
                    @foreach($post->comments as $comment)
                    <div class="flex space-x-4">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900">
                                <span class="text-sm font-semibold text-primary-600 dark:text-primary-400">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </span>
                            </div>
                        </div>

                        <!-- Comment Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>

                                @auth
                                <div class="flex items-center space-x-2">
                                    @if(Auth::id() === $comment->user_id)
                                    @if($editingCommentId == $comment->id)
                                    <a href="{{ route('blog-posts.show', $post) }}"
                                        class="text-sm text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                                        Cancel
                                    </a>
                                    @else
                                    <a href="{{ route('blog-posts.show', ['slug' => $post->slug, 'edit' => $comment->id]) }}"
                                        class="text-sm transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                        Edit
                                    </a>
                                    @endif
                                    @endif

                                    @if(Auth::id() === $comment->user_id || Auth::user()->hasRole('admin'))
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm text-red-600 transition-colors duration-200 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300"
                                            onclick="return confirm('Are you sure you want to delete this comment?')">
                                            Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                @endauth
                            </div>

                            <!-- Edit Form or Comment Text -->
                            @if($editingCommentId == $comment->id)
                            <form method="POST" action="{{ route('comments.update', $comment) }}" class="mt-3">
                                @csrf
                                @method('PUT')
                                <textarea name="content" rows="3"
                                    class="w-full px-3 py-2 text-gray-900 bg-white border border-gray-300 rounded-lg resize-none dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    required>{{ old('content', $comment->content) }}</textarea>
                                @error('content')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <div class="mt-3">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                        Update
                                    </button>
                                </div>
                            </form>
                            @else
                            <div class="prose-sm prose max-w-none dark:prose-invert">
                                <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="py-8 text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full dark:bg-gray-700">
                        <i class="text-2xl text-gray-400 fas fa-comments dark:text-gray-500"></i>
                    </div>
                    <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No comments yet</h3>
                    <p class="text-gray-500 dark:text-gray-400">Be the first to share your thoughts!</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Back to Posts -->
        <div class="mt-8 text-center">
            <a href="{{ route('blog-posts.index') }}"
                class="inline-flex items-center font-medium transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                <i class="mr-2 fas fa-arrow-left"></i>Back to all posts
            </a>
        </div>
    </div>
</div>
@endsection
