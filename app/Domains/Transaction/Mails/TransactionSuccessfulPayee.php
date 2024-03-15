<?php

namespace App\Domains\Transaction\Mails;

use App\Domains\Transaction\Model\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccessfulPayee extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->markdown('emails.transactions.successful_payee')
            ->subject('Transação Concluída - Você é o Recebedor');
    }
}
