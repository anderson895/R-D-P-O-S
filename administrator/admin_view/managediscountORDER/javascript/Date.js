
  // I-set ang kasalukuyang petsa sa ISO format (YYYY-MM-DD).
  var currentDate = new Date().toISOString().slice(0, 10);

  // Kunin ang input element para sa expiration date.
  var expirationDateInput = document.querySelector('input[name="expirationDate"]');

  // I-set ang minimum na petsa sa expiration date input (7 araw mula ngayon).
  var minDate = new Date();
  minDate.setDate(minDate.getDate() + 1);
  var minDateString = minDate.toISOString().slice(0, 10);
  expirationDateInput.min = minDateString;

  




  // I-set ang kasalukuyang petsa sa ISO format (YYYY-MM-DD).
  var currentDate = new Date().toISOString().slice(0, 10);

  // Kunin ang input element para sa expiration date.
  var expirationDateInput = document.querySelector('input[name="expirationDate_update"]');

  // I-set ang minimum na petsa sa expiration date input (7 araw mula ngayon).
  var minDate = new Date();
  minDate.setDate(minDate.getDate() + 1);
  var minDateString = minDate.toISOString().slice(0, 10);
  expirationDateInput.min = minDateString;

  
