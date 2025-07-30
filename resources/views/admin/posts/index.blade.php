@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col mb-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Moderate Blog Posts</h1>
                <p class="text-gray-600 dark:text-gray-400">Approve, reject, or delete submitted posts</p>
            </div>
        </div>

        @if(session('success'))
        <div class="p-4 mb-6 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800">
            <div class="flex items-center">
                <i class="mr-3 text-green-500 fas fa-check-circle"></i>
                <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($posts->count())
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">ID</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Title</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Author</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Category</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Approved</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Created</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:bg-gray-800 dark:divide-gray-700">
                    @foreach($posts as $post)
                    <tr>
                        <td class="px-4 py-3 align-middle text-gray-900 dark:text-white">{{ $post->id }}</td>
                        <td class="px-4 py-3 align-middle">
                            <div class="flex items-center space-x-3">
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="object-cover w-12 h-12 border border-gray-200 rounded shadow-sm dark:border-gray-700">
                                @else
                                <div class="flex items-center justify-center w-12 h-12 rounded bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800">
                                    <i class="text-lg fas fa-newspaper text-primary-600 dark:text-primary-400"></i>
                                </div>
                                @endif
                                <div>
                                    <a href="{{ route('blog-posts.show', $post->slug) }}" class="font-semibold text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400">{{ $post->title }}</a>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-middle text-gray-700 dark:text-gray-300">{{ $post->user->name }}</td>
                        <td class="px-4 py-3 align-middle text-gray-700 dark:text-gray-300">{{ $post->category->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 align-middle">
                            @if($post->is_approved)
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                <i class="mr-1 fas fa-check-circle"></i>Yes
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-200">
                                <i class="mr-1 fas fa-times-circle"></i>No
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle text-gray-500 dark:text-gray-400">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 space-x-2 align-middle">
                            <div class="flex items-center space-x-2">
                                @if(!$post->is_approved)
                                <form action="{{ route('admin.posts.approve', $post) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded bg-green-600 hover:bg-green-700 text-white text-xs font-semibold transition-colors duration-200">
                                        <i class="mr-1 fas fa-check"></i>Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.posts.reject', $post) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold transition-colors duration-200">
                                        <i class="mr-1 fas fa-ban"></i>Reject
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition-colors duration-200">
                                        <i class="mr-1 fas fa-trash"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
        @else
        <div class="py-12 text-center">
            <div class="flex items-center justify-center w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full dark:bg-gray-800">
                <i class="text-3xl text-gray-400 fas fa-newspaper dark:text-gray-500"></i>
            </div>
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No posts found</h3>
            <p class="mb-6 text-gray-500 dark:text-gray-400">There are no posts to moderate at this time.</p>
        </div>
        @endif
    </div>
</div>
@endsection
