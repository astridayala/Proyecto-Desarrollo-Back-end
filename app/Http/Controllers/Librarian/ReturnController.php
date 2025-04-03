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

        $loan = Loan::find($validated['idLoan']);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        if ($loan->loanStatus_id == 3) { // Asumiendo que 3 es el estado "devuelto"
            return response()->json(['message' => 'Loan already returned'], 400);
        }

        if ($loan->loanStatus_id == 4) { // Asumiendo que 4 es el estado "vencido"
            return response()->json(['message' => 'Loan is overdue'], 400);
        }

        $loan->loanStatus_id = 3; // Cambia el estado a "devuelto"
        $loan->returned_at = now(); // Marca la fecha de devolución
        $loan->save();

        return response()->json(['message' => 'Book returned'], 200);
    }
}
