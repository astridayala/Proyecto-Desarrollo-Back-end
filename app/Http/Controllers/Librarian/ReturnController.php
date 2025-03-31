<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idLoan' => 'required|exists:loans,id',
        ]);

        $loan = Loan::findOrFail($validated['idLoan']);
        $loan->loanStatusName = 'returned';
        $loan->save();

        return response()->json(['message' => 'Book returned'], 200);
    }
}
