<?php

namespace App\Domains\Transaction\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'created_at' => $this->created_at->format('d M Y H:i:s'),
            'payee' => new UserResource($this->reciver),
            'payer' => new UserResource($this->sender),
        ];
    }
}
