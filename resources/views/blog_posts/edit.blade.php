@extends('layouts.app')

@section('content')
<div class="container max-w-3xl px-4 py-6 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Edit Blog Post</h1>

    @if ($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-200 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('blog-posts.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block mb-1 font-semibold">Content</label>
            <input id="content" type="hidden" name="content" value="{{ old('content', $blogPost->content) }}">
            <trix-editor input="content" allow-attachment-add="true" class="trix-content"></trix-editor>

            @error('content')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <label for="category_id" class="block mb-1 font-semibold">Category</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 rounded">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $blogPost->category_id) ==
                    $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(collect(old('tags',
                        $selectedTags))->contains($tag->id))>
                    <span class="ml-2">{{ $tag->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <label for="image" class="block mb-1 font-semibold">Featured Image</label>
            <input type="file" name="image" id="image" class="px-3 py-2 border border-gray-300 rounded"
                accept="image/*">
            @if($blogPost->image)
            <img src="{{ asset('storage/' . $blogPost->image) }}" alt="Current Image" class="mt-2 max-h-48">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
