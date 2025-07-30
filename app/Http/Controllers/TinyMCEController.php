<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyMCEController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('tinymce_images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
