<?php
namespace App\Domains\Transaction\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\User\Model\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payee',
        'payer',
    ];

    public function reciver()
    {
        return $this->belongsTo(User::class, 'payee');
    }

    public function sender ()
    {
        return $this->belongsTo(User::class, 'payer');
    }
}
