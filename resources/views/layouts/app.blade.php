<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<script src="//unpkg.com/alpinejs" defer></script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog Platform') }}</title>

    <script>
        if (localStorage.getItem('darkMode') === 'dark' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased transition-colors duration-200 bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
        <header class="bg-white border-b border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center text-gray-600 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Blog Platform') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.umd.min.js"></script>
    <script>
        // Dark mode toggle functionality
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');

            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'dark');
            }
        }

        // Initialize dark mode from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'dark' || (!darkMode && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        });

        // Trix image upload functionality
        document.addEventListener("trix-attachment-add", function(event) {
            if (event.attachment.file) {
                uploadTrixImage(event.attachment);
            }
        });

        function uploadTrixImage(attachment) {
            let file = attachment.file;
            let form = new FormData();
            form.append("image", file);
            form.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute("content"));

            fetch("/trix/image-upload", {
                method: "POST",
                body: form
            })
            .then(response => response.json())
            .then(result => {
                if (result.url) {
                    attachment.setAttributes({
                        url: result.url,
                        href: result.url
                    });
                } else {
                    console.error("Upload failed", result);
                }
            })
            .catch(error => {
                console.error("Upload error", error);
            });
        }
    </script>
</body>

</html>
