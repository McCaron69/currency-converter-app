<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConverterController extends Controller
{
    public function index() {
        $currencyController = new CurrencyController;
        $currencyController->parseActualCurrenciesExchangeRates();
        $currenciesNames = $currencyController->getCurrenciesNames();

        return view('converter', [
            'currencies' => $currenciesNames
        ]);
    }

    public function convert(Request $request) {
        $requestBodyData = json_decode($request->getContent());
        
        $currencyController = new CurrencyController;

        $result = 0;

        try {
            $fromCurrency = $requestBodyData->fromCurrency;
            $toCurrency = $requestBodyData->toCurrency;
            $currencyAmount = $requestBodyData->currencyAmount;
            $ratesDate = $requestBodyData->ratesDate;
        } catch (\Throwable $th) {
            return response()->json('Error: Fields field out incorrectly.');
        }

        $result = $currencyController->convertCurrency($fromCurrency, $toCurrency, $currencyAmount, $ratesDate);

        return response()->json($result);
    }
}
