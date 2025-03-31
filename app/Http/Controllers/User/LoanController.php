<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $loans = Loan::where('user_id', auth()->id())->get();
        return response()->json(['data' => $loans], 200);
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idBook' => 'required|exists:books,id',
        ]);

        $loan = Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $validated['idBook'],
            'date_start_loan' => now(),
            'date_end_loan' => now()->addWeeks(2),
            'loanStatus_id' => 1, // Assume 1 is the status for active loans
        ]);

        return response()->json(['message' => 'Loan submitted', 'data' => $loan], 200);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['loanStatus_id' => 2]); // Assume 2 is for renewed loans
        return response()->json(['message' => 'Loan renewed', 'data' => $loan], 200);
    }
}
