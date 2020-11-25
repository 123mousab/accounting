<?php


namespace App\Services;

use App\Models\Currency;
use App\Models\TransactionCurrency;

class CurrencyService extends BaseService
{

    static protected $model = Currency::class;

    public function createUpdateCurrencies($data)
    {
        $this->transactionCurrency()->create($data);

        return $this->find($data['currency_to'])->update(['price' => $data['price']]);
    }

    public function transactionCurrency()
    {
        return new TransactionCurrency();
    }
}
