<?php

namespace App\Domains\Transaction\DTOs;

class TransactionDTO
{
    public float $amount;
    public int $payerId;
    public int $payeeId;

    public function __construct(float $amount, int $payerId, int $payeeId)
    {
        $this->amount = $amount;
        $this->payerId = $payerId;
        $this->payeeId = $payeeId;
    }
}
