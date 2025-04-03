<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return response()->json(['data' => $books], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'editorial_id' => 'required|exists:editorials,id',
            'publication_date' => 'required|date',
            'ISBN' => 'required|unique:books,ISBN',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);

        return response()->json(['message' => 'Book added', 'data' => $book], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'author_id' => 'exists:authors,id',
            'editorial_id' => 'exists:editorials,id',
            'publication_date' => 'date',
            'ISBN' => 'unique:books,ISBN,' . $id,
            'category_id' => 'exists:categories,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return response()->json(['message' => 'Book updated', 'data' => $book], 200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted'], 200);
    }
}
