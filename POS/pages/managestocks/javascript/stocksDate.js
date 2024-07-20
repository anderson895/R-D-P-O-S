
  // I-set ang kasalukuyang petsa sa ISO format (YYYY-MM-DD).
  var currentDate = new Date().toISOString().slice(0, 10);

  // Kunin ang input element para sa expiration date.
  var expirationDateInput = document.querySelector('input[name="prod_expiration"]');

  // I-set ang minimum na petsa sa expiration date input (7 araw mula ngayon).
  var minDate = new Date();
  minDate.setDate(minDate.getDate() + 7);
  var minDateString = minDate.toISOString().slice(0, 10);
  expirationDateInput.min = minDateString;

  // Alamin kung aling radio button ang na-check sa expirationOption.
  var expirationOptions = document.getElementsByName('expirationOption');

  // Itakda ang pagsusuri ng expirationOptions kapag may pagbabago.
  expirationOptions.forEach(function (option) {
    option.addEventListener('change', function () {
      if (option.value === 'withExpiration') {
        expirationDateInput.disabled = false;
        expirationDateInput.required = true;
      } else {
        expirationDateInput.disabled = true;
        expirationDateInput.required = false;
      }
    });
  });
