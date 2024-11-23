<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
            <h2 class="text-2xl font-bold mb-6">Categories</h2>

            <table class="min-w-full bg-white mb-6">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Category Name</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $category->category_name }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
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
                <a href="{{ route('categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add New Category</a>
            </div>
        </div>
    </div>
</body>
</html>