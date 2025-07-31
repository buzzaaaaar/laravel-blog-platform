@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Create New Post</h1>
                    <p class="text-gray-600 dark:text-gray-400">Share your thoughts with the community</p>
                </div>
                <a href="{{ route('blog-posts.index') }}"
                    class="inline-flex items-center text-gray-600 transition-colors duration-200 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
                    <i class="mr-2 fas fa-arrow-left"></i>Back to Posts
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Post Details</h2>
            </div>

            <form action="{{ route('blog-posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                @if ($errors->any())
                <div class="p-4 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800">
                    <div class="flex items-center">
                        <i class="mr-3 text-red-500 fas fa-exclamation-triangle"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were some errors with your submission</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Title -->
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="Enter your post title..." required>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                    <div class="overflow-hidden bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700">
                        <trix-editor input="content" allow-attachment-add="true"
                            class="trix-content min-h-[300px] p-4 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none"
                            placeholder="Write your post content here..."></trix-editor>
                    </div>
                    @error('content')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category and Image Row -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Featured Image -->
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image</label>
                        <div class="relative">
                            <input type="file" name="image" id="image"
                                class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"
                                accept="image/*">
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a featured image for your post (optional)</p>
                    </div>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                    <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($tags as $tag)
                        <label class="flex items-center p-3 transition-colors duration-200 border border-gray-200 rounded-lg cursor-pointer dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                @checked(collect(old('tags'))->contains($tag->id))
                                class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Select relevant tags to help readers find your post</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('blog-posts.index') }}"
                        class="inline-flex items-center px-4 py-2 font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                        <i class="mr-2 fas fa-paper-plane"></i>Publish Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .trix-content {
        min-height: 300px;
    }
    .trix-content:focus {
        outline: none;
        border-color: transparent;
    }
    .dark .trix-content {
        background-color: rgb(55 65 81);
        color: rgb(255 255 255);
        border-color: rgb(75 85 99);
    }
    .dark .trix-content::placeholder {
        color: rgb(156 163 175);
    }
    .dark .trix-toolbar {
        background-color: rgb(31 41 55);
        border-color: rgb(75 85 99);
    }
    .dark .trix-button {
        color: rgb(209 213 219);
    }
    .dark .trix-button--icon {
        filter: invert(1);
    }
</style>
@endsection
