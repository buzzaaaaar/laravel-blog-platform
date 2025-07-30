@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Admin Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400">Welcome back, {{ auth()->user()->name }}! Here's what's happening with your blog.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-600 dark:text-primary-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\BlogPost::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-green-600 dark:text-green-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Comments -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-comments text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Comments</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Comment::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-red-600 dark:text-red-400"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Posts</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\BlogPost::where('is_approved', false)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-users text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Manage Users</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View and edit user accounts</p>
                    </div>
                </a>

                <a href="{{ route('admin.posts.index') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-newspaper text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Moderate Posts</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Review and approve posts</p>
                    </div>
                </a>

                <a href="{{ route('blog-posts.create') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Create Post</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Write a new blog post</p>
                    </div>
                </a>

                <a href="{{ route('categories.index') }}"
                    class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-tags text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Manage Categories</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Organize content</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Posts</h2>
                <div class="space-y-4">
                    @foreach(\App\Models\BlogPost::latest()->take(5)->get() as $post)
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
                                Approved
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

            <!-- Recent Comments -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Comments</h2>
                <div class="space-y-4">
                    @foreach(\App\Models\Comment::with('user', 'blogPost')->latest()->take(5)->get() as $comment)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary-600 dark:text-primary-400 font-semibold text-xs">
                                {{ substr($comment->user->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                on <a href="{{ route('blog-posts.show', $comment->blogPost->slug) }}" class="hover:text-primary-600 dark:hover:text-primary-400">{{ $comment->blogPost->title }}</a>
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2">{{ Str::limit($comment->content, 100) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
