<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionCurrency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'currency_from',
        'currency_to',
        'price'
    ];

    /**
     * Get the currency record associated with the currency.
     * @return BelongsTo
     */
    public function currencyFrom()
    {
        return $this->belongsTo(Currency::class, 'currency_from');
    }

    /**
     * Get the currency record associated with the currency.
     * @return BelongsTo
     */
    public function currencyTo()
    {
        return $this->belongsTo(Currency::class, 'currency_to');
    }
}
