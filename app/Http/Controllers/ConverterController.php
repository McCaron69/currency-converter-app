<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConverterController extends Controller
{
    public function index() {
        $currencyController = new CurrencyController;
        $currenciesNames = $currencyController->getCurrenciesNames();

        // dd($currenciesNames);

        return view('converter', [
            'currencies' => $currenciesNames
        ]);
    }
}
