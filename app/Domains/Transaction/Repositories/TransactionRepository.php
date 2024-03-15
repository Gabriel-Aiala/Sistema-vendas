<?php
namespace App\Domains\Transaction\Repositories;

use App\Domains\Transaction\DTOs\TransactionDTO;
use App\Domains\Transaction\Model\Transaction;

class TransactionRepository 
{
    public function createTransaction(TransactionDTO $transactionDTO): Transaction
    {
       return Transaction::create([
            'amount' => $transactionDTO->amount,
            'payer' => $transactionDTO->payerId,
            'payee' => $transactionDTO->payeeId,
        ]);
    }
}
