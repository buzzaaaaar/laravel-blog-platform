@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Categories & Tags</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your blog's categories and tags</p>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <!-- Categories Section -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Categories</h2>
                    <button onclick="document.getElementById('category-create-form').scrollIntoView({behavior: 'smooth'})" class="inline-flex items-center px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded transition-colors duration-200">
                        <i class="mr-1 fas fa-plus"></i>New
                    </button>
                </div>
                <div class="mb-6 overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Name</th>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($categories as $category)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 align-middle dark:text-white">{{ $category->name }}</td>
                                <td class="px-4 py-3 align-middle">
                                    <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center px-3 py-1.5 rounded bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold transition-colors duration-200 mr-2">
                                        <i class="mr-1 fas fa-edit"></i>Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition-colors duration-200">
                                            <i class="mr-1 fas fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Create Category Form -->
                <div id="category-create-form" class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Add Category</h3>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                                <i class="mr-2 fas fa-plus"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Tags Section -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Tags</h2>
                    <button onclick="document.getElementById('tag-create-form').scrollIntoView({behavior: 'smooth'})" class="inline-flex items-center px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded transition-colors duration-200">
                        <i class="mr-1 fas fa-plus"></i>New
                    </button>
                </div>
                <div class="mb-6 overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Name</th>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($tags as $tag)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 align-middle dark:text-white">{{ $tag->name }}</td>
                                <td class="px-4 py-3 align-middle">
                                    <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center px-3 py-1.5 rounded bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold transition-colors duration-200 mr-2">
                                        <i class="mr-1 fas fa-edit"></i>Edit
                                    </a>
                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition-colors duration-200">
                                            <i class="mr-1 fas fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Create Tag Form -->
                <div id="tag-create-form" class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Add Tag</h3>
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="tag-name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tag Name</label>
                            <input type="text" name="name" id="tag-name" value="{{ old('name') }}" required class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                                <i class="mr-2 fas fa-plus"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
