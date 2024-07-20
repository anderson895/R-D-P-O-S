  //togglerSeen
  $(document).ready(function() {
    // I-bind ang event handler sa dropdown para sa click event
    $('.togglerSeen').on('click', function() {
        // Gumamit ng AJAX para mag-request sa server
        $.ajax({
            url: 'php/seenCount.php',  // I-update ito sa tamang URL kung saan naka-host ang iyong server script
            type: 'POST',  // I-set ang request method na POST kung kinakailangan
            data: { action: 'update_notification' },  // I-pasa ang data na kailangan
            success: function(response) {
                // Dito mo i-handle ang response mula sa server (kung mayroon man)
                // Halimbawa: alert(response);
                console.log(response)
            }
        });
    });
});







function loadCount() {
    setInterval(function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var noti_number = parseInt(this.responseText); // Parse response as an integer
                var noti_number_element = document.getElementById("noti_number");
                
                // Check if noti_number is 0, and hide the element if it is
                if (noti_number === 0) {
                    noti_number_element.style.display = 'none';
                } else {
                    noti_number_element.style.display = ''; // Show the element
                    noti_number_element.style.backgroundColor = 'red'; // Set background color to red
                    noti_number_element.innerHTML = noti_number;
                }
            }
        };
        xhttp.open("GET", "php/count.php", true);
        xhttp.send();
    }, 1000);
}

  
   function activityLoad() {
    setInterval(function(){
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("loadNotificationAct").innerHTML = this.responseText;
      }
     };
     xhttp.open("GET", "php/loadNotificationAct.php", true);
     xhttp.send();
    },1000);
   }
  
   loadCount();
   activityLoad();