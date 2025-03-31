<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric',
            'reason' => 'required|string',
            'fineStatus_id' => 'required|exists:fine_status,id',
        ]);

        $fine = Fine::create($validated);

        return response()->json(['message' => 'Penalty applied', 'data' => $fine], 200);
    }
}
