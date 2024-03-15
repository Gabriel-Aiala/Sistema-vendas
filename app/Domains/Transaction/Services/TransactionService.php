<?php

namespace App\Domains\Transaction\Services;

use App\Domains\Transaction\Model\Transaction;
use App\Domains\Transaction\Repositories\TransactionRepository;
use Exception;
use App\Domains\User\Services\UserService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Domains\Transaction\DTOs\TransactionDTO;

class TransactionService
{
    protected TransactionRepository $transactionRepository;
    protected UserService $userService;
    public function __construct(TransactionRepository $transactionRepository, UserService $userService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userService = $userService;
    }

    public function createTransaction(TransactionDTO $transactionDTO): Transaction
    {
        $payer = $this->userService->getUserById($transactionDTO->payerId);
        $payee = $this->userService->getUserById($transactionDTO->payeeId);

        $this->userService->validate($payee, $transactionDTO->amount);
        
        if (!$this->approveTransaction()) {
            throw new Exception('Transação não autorizada.',403);
        }

        DB::beginTransaction();

        try {
            $transaction = $this->transactionRepository->createTransaction($transactionDTO);
            $this->userService->updateBalance($payer, -$transactionDTO->amount);
            $this->userService->updateBalance($payee, $transactionDTO->amount);

            DB::commit();
            return $transaction;
        } catch (Exception $erro) {
            DB::rollBack();
            throw $erro;
        }
    }
    public function approveTransaction(): bool
    {
        $response = Http::get("https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6");

        return $response->json('message');
    }
}
