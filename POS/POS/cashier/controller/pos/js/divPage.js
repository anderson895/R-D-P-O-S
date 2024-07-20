
  
  // Kunin ang references sa mga elements



  const viewReceiptDiv = document.getElementById('viewReceipt');
  const requestInfoDiv = document.getElementById('requestInfo');
  const personalInfoDiv = document.getElementById('Personal_info');


  const backButton = document.getElementById('backButton');
  const nextButton2 = document.getElementById('nextButton2');
  const backButton2 = document.getElementById('backButton2');
  const buttonSUbmit = document.getElementById('buttonSUbmit');

  const nextButton = document.getElementById('nextButton');


  
  
  // page 2
  nextButton.addEventListener('click', function(event) {
    event.preventDefault(); // Iwasan ang default behavior ng form submission

    // I-hide ang "viewReceiptDiv" at i-display ang "requestInfoDiv"
    backButton.style.display = 'block';
    nextButton2.style.display = 'none';
    requestInfoDiv.style.display = 'block';

    
    nextButton.style.display = 'none';
    personalInfoDiv.style.display = 'none';  
    viewReceiptDiv.style.display = 'none';
    buttonSUbmit.style.display = 'none';
    
    
    
  });
  
// back to page 1
backButton.addEventListener('click', function(event) {
    event.preventDefault(); // Iwasan ang default behavior ng form submission

    // I-hide ang "viewReceiptDiv" at i-display ang "requestInfoDiv"
   
    nextButton.style.display = 'block';
    viewReceiptDiv.style.display = 'block';

    
    personalInfoDiv.style.display = 'none';  
    requestInfoDiv.style.display = 'none';
    buttonSUbmit.style.display = 'none';

    backButton.style.display = 'none';
    nextButton2.style.display = 'none';
    
    
  });


  // back to page 2
  backButton2.addEventListener('click', function(event) {
    event.preventDefault(); // Iwasan ang default behavior ng form submission

    // I-hide ang "viewReceiptDiv" at i-display ang "requestInfoDiv"
   
    backButton.style.display = 'block';
    nextButton2.style.display = 'block';
    requestInfoDiv.style.display = 'block';

    backButton2.style.display = 'none';
    buttonSUbmit.style.display = 'none';
    
    personalInfoDiv.style.display = 'none';  
    
    
    
  });
  // page 3
  nextButton2.addEventListener('click', function(event) {
    event.preventDefault(); // Iwasan ang default behavior ng form submission

    // I-hide ang "viewReceiptDiv" at i-display ang "requestInfoDiv"
    backButton2.style.display = 'block';
    buttonSUbmit.style.display = 'block';
    personalInfoDiv.style.display = 'block';
    

    backButton.style.display = 'none';
    nextButton2.style.display = 'none';

    viewReceiptDiv.style.display = 'none';
    requestInfoDiv.style.display = 'none';

  });




  


  $(document).ready(function() {
    // Function to check if the "reason" input field is empty or not
    function checkReasonInput() {
      var reasonInputValue = $("#reasonInput").val().trim();
      if (reasonInputValue !== "") {
        $("#nextButton2").show();
      } else {
        $("#nextButton2").hide();
      }
    }

    // Listen for input event in the "reason" input field
    $("#reasonInput").on("input", function() {
      checkReasonInput();
    });

    // Check the initial state of the input field on page load
    checkReasonInput();
  });




