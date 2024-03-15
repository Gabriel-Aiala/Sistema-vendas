<?php

namespace App\Domains\Transaction\Observers;

use App\Domains\Transaction\Model\Transaction;
use App\Domains\Transaction\Mails\TransactionSuccessfulPayee;
use App\Domains\Transaction\Mails\TransactionSuccessfulPayer;
use App\Domains\User\Services\UserService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function created(Transaction $transaction): void
    {
        $this->sendTransactionEmails($transaction);
    }

    private function sendTransactionEmails(Transaction $transaction):void
    {
        $payee = $this->userService->getUserById($transaction->payee);
    
        $payer =  $this->userService->getUserById($transaction->payer);

        $var = Mail::to($payee->email)->send(new TransactionSuccessfulPayee($transaction));

        Mail::to($payer->email)->send(new TransactionSuccessfulPayer($transaction));
    }
}
