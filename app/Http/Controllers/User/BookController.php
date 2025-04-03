<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show()
    {
        $loans = Loan::where('user_id', auth()->id())->with('book')->get();
        $books = $loans->pluck('book');

        return response()->json(['data' => BookResource::collection($books)], 200);
    }
}
