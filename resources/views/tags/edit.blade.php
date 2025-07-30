@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-md px-4 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Edit Tag</h1>
            <p class="text-gray-600 dark:text-gray-400">Update the tag name</p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            @if ($errors->any())
            <div class="p-4 mb-4 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800">
                <ul class="pl-5 text-sm text-red-700 list-disc dark:text-red-300">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tag Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $tag->name) }}" required class="w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                        <i class="mr-2 fas fa-save"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection