<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'book' => new BookResource($this->book),
            'user_id' => $this->user_id,
            'date_start_loan' => $this->date_start_loan,
            'date_end_loan' => $this->date_end_loan,
            'loanStatus_id' => $this->loanStatus_id,
        ];
    }
}
