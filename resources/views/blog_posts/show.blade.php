@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                <li><a href="{{ route('blog-posts.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">Blog Posts</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-gray-900 dark:text-white">{{ $post->title }}</li>
            </ol>
        </nav>

        <!-- Article Header -->
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
            <!-- Featured Image -->
            @if($post->image)
            <div class="aspect-video overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                    class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Article Content -->
            <div class="p-8">
                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">{{ $post->title }}</h1>

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mr-2">
                            <span class="text-primary-600 dark:text-primary-400 font-semibold text-sm">
                                {{ substr($post->author->name ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        <span>{{ $post->author->name ?? 'Anonymous' }}</span>
                    </div>

                    <span class="flex items-center">
                        <i class="fas fa-calendar mr-1"></i>
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
                <div class="mb-6 flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
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
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <!-- Like Button -->
                    @auth
                    <form action="{{ route('blog.like', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                            <i class="fas fa-heart mr-2 {{ Auth::user()->likedPosts->contains($post->id) ? 'text-red-500' : '' }}"></i>
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </button>
                    </form>
                    @else
                    <div class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                        <i class="fas fa-heart mr-2"></i>
                        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                    </div>
                    @endauth

                    <!-- Bookmark Button -->
                    @auth
                    <form action="{{ route('bookmarks.toggle', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                            <i class="fas fa-bookmark mr-2 {{ $hasBookmarked ? 'text-primary-500' : '' }}"></i>
                            <span>{{ $hasBookmarked ? 'Saved' : 'Save for Later' }}</span>
                        </button>
                    </form>
                    @endauth
                </div>

                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-comment mr-1"></i>
                        {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Comments</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Join the conversation</p>
            </div>

            <!-- Comment Form -->
            @auth
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add a comment</label>
                        <textarea name="content" id="content" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
                            placeholder="Share your thoughts..." required></textarea>
                        @error('content')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>Post Comment
                    </button>
                </form>
            </div>
            @else
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="text-center py-4">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Please <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-400 hover:underline font-medium">login</a> to comment.</p>
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
                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                <span class="text-primary-600 dark:text-primary-400 font-semibold text-sm">
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
                                        class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-200">
                                        Cancel
                                    </a>
                                    @else
                                    <a href="{{ route('blog.show', ['slug' => $post->slug, 'edit' => $comment->id]) }}"
                                        class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors duration-200">
                                        Edit
                                    </a>
                                    @endif
                                    @endif

                                    @if(Auth::id() === $comment->user_id || Auth::user()->hasRole('admin'))
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-200"
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
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
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
                            <div class="prose prose-sm max-w-none dark:prose-invert">
                                <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-2xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No comments yet</h3>
                    <p class="text-gray-500 dark:text-gray-400">Be the first to share your thoughts!</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Back to Posts -->
        <div class="mt-8 text-center">
            <a href="{{ route('blog-posts.index') }}"
                class="inline-flex items-center text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to all posts
            </a>
        </div>
    </div>
</div>
@endsection
