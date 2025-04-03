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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'date_start_loan' => 'required|date',
            'date_end_loan' => 'required|date',
            'loan_status_name' => 'required|string',
        ]);

        $loan = Loan::create($validated);

        return response()->json(['message' => 'Loan registered', 'data' => $loan], 200);
    }

    public function cancel(string $id): JsonResponse
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        if ($loan->returned_at !== null) {
            return response()->json(['message' => 'Loan already returned'], 400);
        }

        $loan->returned_at = now();
        $loan->save();

        return response()->json(['message' => 'Loan cancelled'], 200);
    }
    
}
