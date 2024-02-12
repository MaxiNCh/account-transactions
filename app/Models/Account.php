<?php

namespace App\Models;

use App\Exceptions\UnprocessableTransactionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $attributes = [
        'balance' => 0,
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(AccountTransaction::class);
    }

    public function lastTransactions(int $count = 5)
    {
        return $this->transactions()->latest()->limit(5);
    }

    public function provideTransaction(float $amount)
    {
        $newBalance = $this->balance + $amount;

        if ($newBalance < 0) {
            throw new UnprocessableTransactionException();
        }

        $this->balance = $newBalance;
    }
}
