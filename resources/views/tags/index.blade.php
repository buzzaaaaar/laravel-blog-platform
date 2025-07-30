@extends('layouts.app')

@section('content')
<div class="container max-w-3xl px-4 py-6 mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Tags</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">+ New Tag</a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 text-green-800 bg-green-200 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td class="px-4 py-2 border">{{ $tag->name }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('tags.edit', $tag) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
