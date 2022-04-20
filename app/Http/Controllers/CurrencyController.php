<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use XMLReader;

class CurrencyController extends Controller
{
    public function getActualCurrencies() {
        $yesterdayDate = date("Y-m-d", strtotime("yesterday"));

        $this->parseCurrencyToDbByDate($yesterdayDate);

        $actualCurrencies = Currency::where('rateDate', '=', $yesterdayDate)->get();

        return $actualCurrencies;
    }

    public function parseCurrencyToDbByDate($date) {
        if(!count(Currency::where('rateDate', '=', $date)->get())) {
            $this->parseCurrencyFromEestiPankByDate($date);
            $this->parseCurrencyFromLeeduPankByDate($date);
        }
        $this->parseCurrencyFromLeeduPankByDate($date);
    }

    public function parseCurrencyFromEestiPankByDate($date)
    {
        $reader = simplexml_load_file('https://haldus.eestipank.ee/et/export/currency_rates?imported=' . $date . '&type=xml');

        foreach ($reader->Cube->Cube->Cube as $currency) {
            $currencyModel = new Currency();
            $currencyModel->abbreviation = $currency['currency'];
            $currencyModel->rateToEuro = $currency['rate'];
            $currencyModel->rateDate = $date;
            $currencyModel->rateSource = "Eesti Pank";
            $currencyModel->save();
        }
    }

    public function parseCurrencyFromLeeduPankByDate($date)
    {
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
