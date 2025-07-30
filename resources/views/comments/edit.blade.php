@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="mb-4 text-xl font-bold">Edit Comment</h2>

    <form method="POST" action="{{ route('comments.update', $comment) }}">
        @csrf
        @method('PUT')
        <textarea name="content" rows="4" class="w-full p-2 border border-gray-300 rounded" required>{{ old('content', $comment->content) }}</textarea>

        <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Update
        </button>
    </form>
</div>
@endsection
