  // Kumuhang kasalukuyang petsa sa Pilipinas
  const nowInPH = new Date();
  nowInPH.setHours(nowInPH.getHours() + 8); // I-adjust ang oras sa Pilipinas (UTC+8)

  // Kunin ang input element gamit ang ID
  const dateInput = document.getElementById('datePick');

  // Itakda ang minimum na petsa sa input element
  dateInput.min = nowInPH.toISOString().slice(0, 10); // Format: "YYYY-MM-DD"

  var datePickInput = document.getElementById("datePick");
  var timePickInput = document.getElementById("timePick");
  var form = document.getElementById("pickupForm"); // Palitan mo ito ng ID ng iyong form
  
  if (localStorage.getItem("savedDate")) {
      datePickInput.value = localStorage.getItem("savedDate");
  }
  
  if (localStorage.getItem("savedTime")) {
      timePickInput.value = localStorage.getItem("savedTime");
  }
  
  datePickInput.addEventListener("change", function () {
      localStorage.setItem("savedDate", datePickInput.value);
  });
  
  timePickInput.addEventListener("change", function () {
      localStorage.setItem("savedTime", timePickInput.value);
  });
  
  form.addEventListener("submit", function () {
      localStorage.removeItem("savedDate");
      localStorage.removeItem("savedTime");
  });
  
