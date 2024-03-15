<?php

namespace  App\Domains\Transaction\Http\Controllers;

use App\Domains\Transaction\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Domains\Transaction\DTOs\TransactionDTO;
use App\Domains\Transaction\Http\Requests\TransactionCreateRequest;
use App\Domains\Transaction\Resources\TransactionResource;

class TransactionController extends Controller
{

    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(TransactionCreateRequest $request)
    {
        $Dto = new TransactionDTO(
            $request->amount,
            $request->payer,
            $request->payee
        );
         
        $transaction = $this->transactionService->createTransaction($Dto);

        return new TransactionResource($transaction);
    }
}