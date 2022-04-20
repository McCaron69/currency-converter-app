<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConverterController extends Controller
{
    public function index() {
        $currencyController = new CurrencyController;
        $actualCurrencies = $currencyController->getActualCurrencies();

        return view('converter', [
            'currencies' => $actualCurrencies
        ]);
    }
}
