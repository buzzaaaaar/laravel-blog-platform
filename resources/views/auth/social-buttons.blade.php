<div class="mt-6 space-y-2">
    <a href="{{ url('/auth/google/redirect') }}"
       class="inline-flex items-center justify-center w-full px-4 py-2 text-white transition bg-red-600 rounded-md shadow hover:bg-red-700">
        <i class="fa-brands fa-google"></i>
        Login with Google
    </a>

    <a href="{{ url('/auth/github/redirect') }}"
       class="inline-flex items-center justify-center w-full px-4 py-2 text-white transition bg-gray-800 rounded-md shadow hover:bg-gray-900">
        <i class="fa-brands fa-github"></i>
        Login with GitHub
    </a>
</div>
