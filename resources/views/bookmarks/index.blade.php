@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Saved Posts</h1>
                <p class="text-gray-600 dark:text-gray-400">All your bookmarked blog posts in one place</p>
            </div>
            <a href="{{ route('blog-posts.index') }}" class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200 mt-4 sm:mt-0">
                <i class="fas fa-arrow-left mr-2"></i>Back to All Posts
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($bookmarkedPosts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookmarkedPosts as $post)
            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <!-- Post Image -->
                @if($post->image)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                </div>
                @else
                <div class="aspect-video bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 flex items-center justify-center">
                    <i class="fas fa-newspaper text-4xl text-primary-600 dark:text-primary-400"></i>
                </div>
                @endif

                <!-- Post Content -->
                <div class="p-6">
                    <!-- Category -->
                    @if($post->category)
                    <div class="mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    @endif

                    <!-- Title -->
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2">
                        <a href="{{ route('blog-posts.show', $post->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Tags -->
                    @if($post->tags->count())
                    <div class="mb-4 flex flex-wrap gap-1">
                        @foreach($post->tags->take(3) as $tag)
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            #{{ $tag->name }}
                        </span>
                        @endforeach
                        @if($post->tags->count() > 3)
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            +{{ $post->tags->count() - 3 }} more
                        </span>
                        @endif
                    </div>
                    @endif

                    <!-- Meta Information -->
                    <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mr-2">
                                <span class="text-primary-600 dark:text-primary-400 font-semibold text-xs">
                                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                                </span>
                            </div>
                            <span>{{ $post->author->name ?? 'Anonymous' }}</span>
                        </div>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <form action="{{ route('bookmarks.toggle', $post) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900 transition-colors duration-200">
                                <i class="fas fa-bookmark mr-2"></i>Unsave
                            </button>
                        </form>
                        <a href="{{ route('blog-posts.show', $post->slug) }}" class="inline-flex items-center text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium transition-colors duration-200">
                            <i class="fas fa-eye mr-2"></i>View
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $bookmarkedPosts->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bookmark text-3xl text-yellow-600 dark:text-yellow-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No saved posts yet</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't bookmarked any posts. Start saving your favorite articles!</p>
            <a href="{{ route('blog-posts.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-newspaper mr-2"></i>Browse Posts
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
