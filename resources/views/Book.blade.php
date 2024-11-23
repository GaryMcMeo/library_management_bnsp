<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
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

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Books</h2>
                <form action="{{ route('Book') }}" method="GET" class="flex items-center">
                    <label for="category_id" class="mr-2">Filter by Category:</label>
                    <select name="category_id" id="category_id" class="p-2 border border-gray-300 rounded">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Filter</button>
                </form>
            </div>

            <table class="min-w-full bg-white mb-6">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Title</th>
                        <th class="py-2 px-4 border-b text-left">Categories</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                            <td class="py-2 px-4 border-b">
                                @foreach($book->categories as $category)
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded">{{ $category->category_name }}</span>
                                @endforeach
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('book.edit', $book->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end">
                <a href="{{ route('book.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add New Book</a>
            </div>
        </div>
    </div>
</body>
</html>