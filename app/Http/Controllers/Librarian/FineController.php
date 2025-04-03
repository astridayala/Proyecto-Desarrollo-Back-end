<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FineController extends Controller
{
    public function index(): JsonResponse
    {
        $fines = Fine::with(['user', 'loan', 'fineStatus'])->get();
        return response()->json($fines);
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string',
            'fineStatus_id' => 'required|exists:fine_status,id',
        ]);

        $loan = Loan::find($validated['loan_id']);
        if (!$loan || $loan->returned_at !== null) {
            return response()->json(['message' => 'Invalid loan or loan already returned.'], 400);
        }

        $fine = Fine::create($validated);

        return response()->json(['message' => 'Penalty applied', 'data' => $fine], 201);
    }

    public function destroy(string $id): JsonResponse
    {
        $fine = Fine::find($id);

        if (!$fine) {
            return response()->json(['message' => 'Fine not found.'], 404);
        }

        $fine->delete();

        return response()->json(['message' => 'Fine removed.'], 200);
    }
}