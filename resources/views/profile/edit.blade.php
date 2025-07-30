@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Profile') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your account information, password, and privacy.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @include('profile.partials.update-profile-information-form', ['user' => $user])
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @include('profile.partials.update-password-form', ['user' => $user])
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @include('profile.partials.delete-user-form', ['user' => $user])
        </div>
    </div>
</div>
@endsection
