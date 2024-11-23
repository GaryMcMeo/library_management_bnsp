<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
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
            <h2 class="text-2xl font-bold mb-6">Members</h2>

            <table class="min-w-full bg-white mb-6">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Borrowed Books</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $member->name }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($member->books->isNotEmpty())
                                    <ul>
                                        @foreach($member->books as $book)
                                            <li>{{ $book->title }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>No books borrowed</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('member.edit', $member->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                                <form action="{{ route('member.destroy', $member->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <form action="{{ route('member.borrowBook', $member->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <select name="book_id" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded mt-2">Borrow Book</button>
                                </form>
                                @if($member->books->isNotEmpty())
                                    <form action="{{ route('member.returnBook', $member->books->first()->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded mt-2">Return Book</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end">
                <a href="{{ route('member.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add Member</a>
            </div>
        </div>
    </div>
</body>
</html>