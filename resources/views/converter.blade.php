@extends('layout')
@section('title', 'Currency converter')
@section('content') 
    <h1>Currency converter</h1>
    <div id="converterFormContainer">
        <input type="number" id="converterValueInput">
        <select name="" id="currencyFrom">
            <option value="EUR">Euro (EUR)</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->abbreviation }}">{{ $currency->currencyName->name }} ({{ $currency->abbreviation }})</option>
            @endforeach
        </select>
        →
        <select name="" id="currencyTo">
            <option value="EUR">Euro (EUR)</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->abbreviation }}">{{ $currency->currencyName->name }} ({{ $currency->abbreviation }})</option>
            @endforeach
        </select>
        <input id="datePicker">
        <button id="converterSubmitBtn">Convert</button>
        <div id="convertResult"></div>
    </div>
@endsection