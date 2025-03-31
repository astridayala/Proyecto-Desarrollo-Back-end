<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idUser' => 'required|exists:users,id',
            'idBook' => 'required|exists:books,id',
            'dateStartLoan' => 'required|date',
            'dateEndLoan' => 'required|date',
            'loanStatusName' => 'required|string',
        ]);

        $loan = Loan::create($validated);

        return response()->json(['message' => 'Loan registered', 'data' => $loan], 200);
    }
}
