@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Blog Posts</h1>
                    <p class="text-gray-600 dark:text-gray-400">Discover and explore our latest articles</p>
                </div>
                @auth
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
                <a href="{{ route('blog-posts.create') }}"
                    class="inline-flex items-center px-4 py-2 mt-4 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700 sm:mt-0">
                    <i class="mr-2 fas fa-plus"></i>New Post
                </a>
                @endif
                @endauth
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

        <!-- Filters Section -->
        <div
            class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <form id="filterForm" method="GET" action="{{ route('blog-posts.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Search Input -->
                    <div>
                        <label for="searchInput"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                        <div class="relative">
                            <i
                                class="absolute text-gray-400 transform -translate-y-1/2 fas fa-search left-3 top-1/2"></i>
                            <input type="text" name="search" id="searchInput" placeholder="Search posts..."
                                value="{{ request('search') }}"
                                class="w-full py-2 pl-10 pr-4 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="categorySelect"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <div x-data="{ open: false }" class="relative">
                            <!-- Dropdown button -->
                            <button type="button" @click="open = !open"
                                class="w-full px-4 py-2 text-left bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                Select Categories
                                <span class="float-right">&#9662;</span>
                            </button>

                            <!-- Dropdown panel -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-600">
                                <div class="p-2 overflow-y-auto max-h-60">
                                    @foreach($categories as $category)
                                    <label
                                        class="flex items-center p-2 space-x-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                            @if(is_array(request('category')) && in_array($category->id,
                                        request('category'))) checked @endif
                                        class="border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Tag Filter -->
                    <div>
                        <label for="tagSelect"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tag</label>
                        <div x-data="{ open: false }" class="relative">
                            <button type="button" @click="open = !open"
                                class="w-full px-4 py-2 text-left bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                Select Tags
                                <span class="float-right">&#9662;</span>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-600">
                                <div class="p-2 overflow-y-auto max-h-60">
                                    @foreach($tags as $tag)
                                    <label
                                        class="flex items-center p-2 space-x-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <input type="checkbox" name="tag[]" value="{{ $tag->id }}"
                                            @if(is_array(request('tag')) && in_array($tag->id, request('tag'))) checked
                                        @endif
                                        class="border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Author Filter -->
                    <div>
                        <label for="authorSelect"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                        <div x-data="{ open: false }" class="relative">
                            <button type="button" @click="open = !open"
                                class="w-full px-4 py-2 text-left bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                Select Authors
                                <span class="float-right">&#9662;</span>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-600">
                                <div class="p-2 overflow-y-auto max-h-60">
                                    @foreach($authors as $author)
                                    <label
                                        class="flex items-center p-2 space-x-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <input type="checkbox" name="author[]" value="{{ $author->id }}"
                                            @if(is_array(request('author')) && in_array($author->id, request('author')))
                                        checked @endif
                                        class="border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $author->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Saved Posts Filter -->
                @auth
                <div class="flex items-center">
                    <input type="checkbox" name="saved" id="savedCheckbox" value="1" @checked(request('saved'))
                        class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                    <label for="savedCheckbox" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Show Saved Posts
                        Only</label>
                </div>
                @endauth

                <noscript>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                        <i class="mr-2 fas fa-filter"></i>Apply Filters
                    </button>
                </noscript>
            </form>
        </div>

        <!-- Posts Grid -->
        @if($posts->count())
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($posts as $post)
            <article
                class="overflow-hidden transition-shadow duration-200 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md">
                <!-- Post Image -->
                @if($post->image)
                <div class="overflow-hidden aspect-video">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="object-cover w-full h-full transition-transform duration-200 hover:scale-105">
                </div>
                @else
                <div
                    class="flex items-center justify-center aspect-video bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800">
                    <i class="text-4xl fas fa-newspaper text-primary-600 dark:text-primary-400"></i>
                </div>
                @endif

                <!-- Post Content -->
                <div class="p-6">
                    <!-- Category -->
                    @if($post->category)
                    <div class="mb-3">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    @endif

                    <!-- Title -->
                    <h2 class="mb-3 text-xl font-bold text-gray-900 dark:text-white line-clamp-2">
                        <a href="{{ route('blog-posts.show', $post->slug) }}"
                            class="transition-colors duration-200 hover:text-primary-600 dark:hover:text-primary-400">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Tags -->
                    @if($post->tags->count())
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach($post->tags->take(3) as $tag)
                        <span
                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-700 dark:text-gray-300">
                            #{{ $tag->name }}
                        </span>
                        @endforeach
                        @if($post->tags->count() > 3)
                        <span
                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-md dark:bg-gray-700 dark:text-gray-300">
                            +{{ $post->tags->count() - 3 }} more
                        </span>
                        @endif
                    </div>
                    @endif

                    <!-- Meta Information -->
                    <div class="flex items-center justify-between mb-4 text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center">
                            <div
                                class="flex items-center justify-center w-6 h-6 mr-2 rounded-full bg-primary-100 dark:bg-primary-900">
                                <span class="text-xs font-semibold text-primary-600 dark:text-primary-400">
                                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                                </span>
                            </div>
                            <span>{{ $post->author->name ?? 'Anonymous' }}</span>
                        </div>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i class="mr-1 fas fa-heart"></i>
                                {{ $post->likes->count() }}
                            </span>
                            <span class="flex items-center">
                                <i class="mr-1 fas fa-comment"></i>
                                {{ $post->comments->count() }}
                            </span>
                        </div>

                        @auth
                        @if(auth()->user()->hasRole('admin') || auth()->user()->id === $post->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('blog-posts.edit', $post->id) }}"
                                class="flex transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('blog-posts.destroy', $post->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex p-0 text-red-600 transition-colors duration-200 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>

                        @endif
                        @endauth
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="py-12 text-center">
            <div
                class="flex items-center justify-center w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full dark:bg-gray-800">
                <i class="text-3xl text-gray-400 fas fa-newspaper dark:text-gray-500"></i>
            </div>
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No posts found</h3>
            <p class="mb-6 text-gray-500 dark:text-gray-400">Try adjusting your search criteria or check back later for
                new content.</p>
            @auth
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
            <a href="{{ route('blog-posts.create') }}"
                class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                <i class="mr-2 fas fa-plus"></i>Create First Post
            </a>
            @endif
            @endauth
        </div>
        @endif
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const categorySelect = document.getElementById('categorySelect');
        const tagSelect = document.getElementById('tagSelect');
        const authorSelect = document.getElementById('authorSelect');
        const savedCheckbox = document.getElementById('savedCheckbox');
        const searchInput = document.getElementById('searchInput');

        // Submit form when dropdowns or checkbox change
        [categorySelect, tagSelect, authorSelect, savedCheckbox].forEach(element => {
            if (element) {
                element.addEventListener('change', () => {
                    filterForm.submit();
                });
            }
        });

        // Submit on search input change (with debounce)
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        }
    });
</script>
