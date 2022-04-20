document.getElementById("converterSubmitBtn").addEventListener("click", function() {
  document.getElementById("convertResult").innerHTML = "Result: ";
});

var yesterdayDate = new Date().setDate(new Date().getDate() - 1);

$("#datePicker").flatpickr( {
  minDate: "2002-02-18",
  maxDate: yesterdayDate,
  defaultDate: yesterdayDate
});