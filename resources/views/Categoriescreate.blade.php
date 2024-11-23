<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('header')

    <div class="container mx-auto mt-8">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Add Category</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="category_name" class="block text-gray-700">Category</label>
                    <input type="text" name="category_name" id="category_name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</button>
            </form>
        </div>
    </div>
</body>
</html>
