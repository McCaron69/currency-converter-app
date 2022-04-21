<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $table = 'currencies_rates';

    protected $guarded = [];

    public $timestamps = false;

    public function currencyName() {
        return $this->hasOne(CurrencyName::class, 'abbreviation', 'currencyAbbreviation');
    }
}
