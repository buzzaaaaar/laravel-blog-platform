@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 dark:text-gray-400">Here's what's happening with your blog today.</p>
        </div>

        <!-- User Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- My Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-600 dark:text-primary-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">My Posts</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->blogPosts->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- My Comments -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-comments text-green-600 dark:text-green-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">My Comments</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->comments->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Saved Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bookmark text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saved Posts</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->bookmarkedPosts->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('blog-posts.index') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-newspaper text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Browse Posts</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Read all blog posts</p>
                    </div>
                </a>

                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
                <a href="{{ route('blog-posts.create') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Create Post</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Write a new article</p>
                    </div>
                </a>
                @endif

                <a href="{{ route('bookmarks.index') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-bookmark text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Saved Posts</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View your bookmarks</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Edit Profile</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Update your settings</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- My Recent Posts -->
            @if(auth()->user()->blogPosts->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">My Recent Posts</h2>
                <div class="space-y-4">
                    @foreach(auth()->user()->blogPosts()->latest()->take(5)->get() as $post)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                <a href="{{ route('blog-posts.show', $post->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400">
                                    {{ $post->title }}
                                </a>
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($post->is_approved)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                Pending
                            </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Comments -->
            @if(auth()->user()->comments->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">My Recent Comments</h2>
                <div class="space-y-4">
                    @foreach(auth()->user()->comments()->with('blogPost')->latest()->take(5)->get() as $comment)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary-600 dark:text-primary-400 font-semibold text-xs">
                                {{ substr($comment->user->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                on <a href="{{ route('blog-posts.show', $comment->blogPost->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400">{{ $comment->blogPost->title }}</a>
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2">{{ Str::limit($comment->content, 80) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Empty State for New Users -->
        @if(auth()->user()->blogPosts->count() == 0 && auth()->user()->comments->count() == 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center">
            <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-rocket text-2xl text-primary-600 dark:text-primary-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Welcome to BlogHub!</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by exploring posts, creating content, or engaging with the community.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('blog-posts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-newspaper mr-2"></i>Browse Posts
                </a>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
                <a href="{{ route('blog-posts.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Create First Post
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
