@extends('layout')
@section('title', 'Currency converter')
@section('content')
    <div id="converterFormContainer">
        <h1>CURRENCY CONVERTER</h1>
        <input type="number" id="converterValueInput">
        <div id="middleRow">
            <select name="" id="currencyFrom">
                @foreach ($currencies as $currency)
                    <option value="{{ strval($currency->abbreviation) }}">{{ $currency->name }} ({{ $currency->abbreviation }})</option>
                @endforeach
            </select>
            →
            <select name="" id="currencyTo">
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->abbreviation }}">{{ $currency->name }} ({{ $currency->abbreviation }})</option>
                @endforeach
            </select>
            <input id="ratesDatePicker">
        </div>
        <button id="converterSubmitBtn">Convert</button>
        <div id="convertResult"></div>
    </div>
@endsection