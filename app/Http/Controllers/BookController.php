<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Categories;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Categories::all();
        $selectedCategory = $request->input('category_id');

        if ($selectedCategory) {
            $books = Book::whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories_id', $selectedCategory);
            })->with('categories')->get();
        } else {
            $books = Book::with('categories')->get();
        }

        return view('Book', compact('books', 'categories', 'selectedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        if ($categories->isEmpty()) {
            return redirect()->route('book')->with('error', 'You must create at least one category before adding a book.');
        }
        return view('Bookcreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'categories.required' => 'You must select at least one category.',
        ]);

        $book = Book::create($request->only('title'));
        $book->categories()->attach($request->categories);

        return redirect()->route('Book')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Categories::all();
        return view('Bookedit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $book->update($request->only('title'));
        $book->categories()->sync($request->categories);

        return redirect()->route('Book')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('Book')->with('success', 'Book deleted successfully.');
    }
}
