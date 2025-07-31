<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TrixController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TinyMCEController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogPostModerationController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comments (store, edit, update, destroy)
    Route::post('/blog/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Likes
    Route::post('/blog/{post}/like', [BlogPostController::class, 'like'])->name('blog.like');

    // Bookmarks (Save for Later)
    Route::post('/blog-posts/{post}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
});

// Social Auth
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

// Public blog viewing routes
Route::get('blog-posts', [BlogPostController::class, 'index'])->name('blog-posts.index');

// Blog post management routes
Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::get('blog-posts/create', [BlogPostController::class, 'create'])->name('blog-posts.create');
    Route::post('blog-posts', [BlogPostController::class, 'store'])->name('blog-posts.store');
    Route::get('blog-posts/{blog_post}/edit', [BlogPostController::class, 'edit'])->name('blog-posts.edit');
    Route::put('blog-posts/{blog_post}', [BlogPostController::class, 'update'])->name('blog-posts.update');
    Route::delete('blog-posts/{blog_post}', [BlogPostController::class, 'destroy'])->name('blog-posts.destroy');
});

// Slug route
Route::get('blog-posts/{slug}', [BlogPostController::class, 'show'])->name('blog-posts.show');


// Categories & Tags (auth required)
Route::resource('categories', CategoryController::class)->middleware('auth');
Route::resource('tags', TagController::class)->middleware('auth');

// Trix upload
Route::post('/trix/image-upload', [TrixController::class, 'upload'])->name('trix.upload');

// Admin routes (admin only)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
    Route::resource('posts', BlogPostModerationController::class)->only(['index', 'destroy']);
    Route::post('posts/{post}/approve', [BlogPostModerationController::class, 'approve'])->name('posts.approve');
    Route::post('posts/{post}/reject', [BlogPostModerationController::class, 'reject'])->name('posts.reject');
    Route::delete('posts/{post}', [BlogPostModerationController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__ . '/auth.php';
