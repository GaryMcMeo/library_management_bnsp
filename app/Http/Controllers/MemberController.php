<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Book;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('books')->get();
        $books = Book::where('is_borrowed', false)->get();
        return view('member', compact('members', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('membercreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::createMember($request->all());

        return redirect()->route('Member')->with('success', 'Member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $books = Book::where('is_borrowed', false)->get();
        return view('memberedit', compact('member', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
        ]);

        $member->update($request->all());

        return redirect()->route('Member')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('Member')->with('success', 'Member deleted successfully.');
    }
    public function borrowBook(Request $request, Member $member)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($request->book_id);
        if ($book->is_borrowed) {
            return redirect()->route('Member')->with('error', 'Book is already borrowed.');
        }

        $book->update([
            'is_borrowed' => true,
            'member_id' => $member->id,
        ]);

        return redirect()->route('Member')->with('success', 'Book borrowed successfully.');
    }

    public function returnBook(Book $book)
    {
        $book->update([
            'is_borrowed' => false,
            'member_id' => null,
        ]);

        return redirect()->route('Member')->with('success', 'Book returned successfully.');
    }
}
