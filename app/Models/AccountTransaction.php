<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountTransaction extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'account_id',
        'amount',
        'note',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
