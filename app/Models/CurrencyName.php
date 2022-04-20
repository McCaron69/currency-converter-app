<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyName extends Model
{
    use HasFactory;

    protected $table = 'currency_names';

    protected $primaryKey = 'abbreviation';

    public $incrementing = false;
}
