<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-bold">
            <a href="{{ route('index') }}">Library Management System</a>
        </div>
        <div class="space-x-4">
            <a href="{{ route('Book') }}" class="text-gray-300 hover:text-white">Books</a>
            <a href="{{ route('Categories') }}" class="text-gray-300 hover:text-white">Categories</a>
            <a href="{{ route('Member') }}" class="text-gray-300 hover:text-white">Member</a>
        </div>
    </div>
</nav>

