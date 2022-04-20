<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currency converter</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
</head>
<body>
    <div id="mainContainer">
        <h1>Currency converter</h1>
        <div id="converterFormContainer">
            <input type="number" id="converterValueInput">
            <select name="" id=""></select>
            → <select name="" id=""></select>
            <button id="converterSubmitBtn">Convert</button>
            <div id="convertResult"></div>
        </div>
    </div>
    <script src="{{ url('/js/converter.js') }}"></script>
</body>
</html>