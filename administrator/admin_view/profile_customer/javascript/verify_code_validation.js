document.addEventListener("input", function(event) {
    if (event.target.classList.contains("code1")) {
      const inputValue = event.target.value;
      if (inputValue.length > 1) {
        event.target.value = inputValue.slice(0, 1);
      }
      
      if (inputValue.length === 1) {
        event.target.nextElementSibling.focus();
      }
    }
  });