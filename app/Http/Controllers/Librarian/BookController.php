<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'editorial', 'category'])->get();
        return response()->json($books);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'editorial_id' => 'required|exists:editorials,id',
            'publication_date' => 'required|date',
            'ISBN' => 'required|string|max:20|unique:books',
            'category_id' => 'required|exists:categories,id',
            'availability' => 'required|boolean',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }
    public function show(string $id): JsonResponse
    {
        $book = Book::with(['author', 'editorial', 'category'])->findOrFail($id);
        return response()->json($book);
    }
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'editorial_id' => 'required|exists:editorials,id',
            'publication_date' => 'required|date',
            'ISBN' => 'required|string|max:20|unique:books,ISBN,' . $id,
            'category_id' => 'required|exists:categories,id',
            'availability' => 'required|boolean',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book);
    }
    public function destroy(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}