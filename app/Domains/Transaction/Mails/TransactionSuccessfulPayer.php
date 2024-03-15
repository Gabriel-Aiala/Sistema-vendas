<?php

namespace App\Domains\Transaction\Mails;

use App\Domains\Transaction\Model\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccessfulPayer extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.transactions.successful_payer')
            ->subject('Transação Concluída - Você é o Pagador');
    }
}
