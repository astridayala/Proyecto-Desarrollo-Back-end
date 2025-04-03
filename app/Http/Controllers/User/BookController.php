<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan; // Importa el modelo Loan
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show()
    {
        $loans = Loan::where('user_id', auth()->id())->with('book')->get();

        $books = $loans->pluck('book');

        return response()->json(['data' => $books], 200);
    }
}