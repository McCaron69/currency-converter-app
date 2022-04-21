$("#converterSubmitBtn").click(function() {
  var fromCurrency = $("#currencyFrom").val();
  var toCurrency = $("#currencyTo").val();
  var currencyAmount = $("#converterValueInput").val();
  var ratesDate = $("#ratesDatePicker").val();

  $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: 'http://127.0.0.1:8000/api/convert',
    dataType: 'json',
    data: JSON.stringify({'fromCurrency':fromCurrency, 'toCurrency':toCurrency, 'currencyAmount':currencyAmount, 'ratesDate':ratesDate}),
    success: function(result) {
      var resultsTable = '<table id="ratesTable">';
      for (var key in result) {
        if (result.hasOwnProperty(key)) {
          resultsTable += '<tr><td>' + key +'</td><td>' + result[key].toFixed(4) +'</td></tr>';
        }
      }
      resultsTable += "</table>";
      $("#convertResult").html(resultsTable);
    },
    error: function() {
      $("#convertResult").html("Error occured.");
    }
  })

  
});

var yesterdayDate = new Date().setDate(new Date().getDate() - 1);

$("#ratesDatePicker").flatpickr( {
  minDate: "2002-02-18",
  maxDate: yesterdayDate,
  defaultDate: yesterdayDate
});