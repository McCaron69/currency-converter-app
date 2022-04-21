<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencyRate;
use App\Models\CurrencyName;

class CurrencyController extends Controller
{
    public function getCurrenciesNames()
    {
        return CurrencyName::orderBy('name', 'asc')->get();
    }

    public function convertCurrency($fromCurrency, $toCurrency, $currencyAmount, $ratesDate)
    {
        $convertedResult = [
            "Eesti Pank" => 
                $this->convertCurrencyWithSpecifiedRateSource(
                    $fromCurrency, $toCurrency, $currencyAmount, $ratesDate, "Eesti Pank"),
            "Leedu Pank" => 
                $this->convertCurrencyWithSpecifiedRateSource(
                    $fromCurrency, $toCurrency, $currencyAmount, $ratesDate, "Leedu Pank")
                ];
                
        return $convertedResult;
    }

    public function convertCurrencyWithSpecifiedRateSource($fromCurrency, $toCurrency, $currencyAmount, $ratesDate, $rateSource)
    {
        try {
            $fromCurrencyData = $this->getCurrencyRateByDateAndSource($fromCurrency, $ratesDate, $rateSource);
            $toCurrencyData = $this->getCurrencyRateByDateAndSource($toCurrency, $ratesDate, $rateSource);
            
            return $currencyAmount / $fromCurrencyData->rateToEuro * $toCurrencyData->rateToEuro;
        } catch (\Throwable $th) {
            return "No data";
        }
    }

    public function getCurrencyRateByDateAndSource($currency, $rateDate, $rateSource)
    {
        if(!strcmp($currency, "EUR")) {
            return $this->getEuroCurrencyRate();
        }

        $this->parseExchangeRatesToDbByDate($rateDate);

        return CurrencyRate::where([
            ['currencyAbbreviation', '=', $currency],
            ['rateDate', '=', $rateDate],
            ['rateSource', '=', $rateSource]
        ])->first();
    }

    public function getEuroCurrencyRate()
    {
        $euroCurrencyRate = new CurrencyRate();

        $euroCurrencyRate->currencyAbbreviation = "EUR";
        $euroCurrencyRate->rateToEuro = 1.00;
        $euroCurrencyRate->rateDate = date("Y-m-d", strtotime("yesterday"));
        $euroCurrencyRate->rateSource = "Eesti Pank";

        return $euroCurrencyRate;
    }

    public function parseActualCurrenciesExchangeRates() {
        $yesterdayDate = date("Y-m-d", strtotime("yesterday"));

        $this->parseExchangeRatesToDbByDate($yesterdayDate);
    }

    public function parseExchangeRatesToDbByDate($date) {
        if(!count(CurrencyRate::where('rateDate', '=', $date)->get())) {
            $this->parseExchangeRatesFromEestiPankByDate($date);
            $this->parseExchangeRatesFromLeeduPankByDate($date);
        }
    }

    public function parseExchangeRatesFromEestiPankByDate($date)
    {
        $reader = simplexml_load_file('https://haldus.eestipank.ee/et/export/currency_rates?imported=' . $date . '&type=xml');

        foreach ($reader->Cube->Cube->Cube as $currency) {
            $currencyModel = new CurrencyRate();
            $currencyModel->currencyAbbreviation = $currency['currency'];
            $currencyModel->rateToEuro = $currency['rate'];
            $currencyModel->rateDate = $date;
            $currencyModel->rateSource = "Eesti Pank";
            $currencyModel->save();
        }
    }

    public function parseExchangeRatesFromLeeduPankByDate($date)
    {
        $currenciesString = file_get_contents('https://www.lb.lt/fxrates_csv.lb?tp=EU&rs=1&dte=' . $date);

        $currenciesArray = explode("\n", $currenciesString);

        foreach ($currenciesArray as $currencyData) {
            $currencyDataArray = explode(',', $currencyData);

            $currencyModel = new CurrencyRate();
            $currencyModel->currencyAbbreviation = $currencyDataArray[1];
            $currencyModel->rateToEuro = $currencyDataArray[2];
            $currencyModel->rateDate = $date;
            $currencyModel->rateSource = "Leedu Pank";
            $currencyModel->save();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
