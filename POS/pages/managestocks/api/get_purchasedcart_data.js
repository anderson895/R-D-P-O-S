// Function to get purchased cart data
   
  
    function getPurchasedCartData() {

      var acc_id =$("#acc_id").val()
      const selectedSupplierId = document.getElementById('supplier').value;
      const url = `managestocks/api/get_purchasedcart_data.php?supplier_id=${selectedSupplierId}&acc_id=${acc_id}`;


      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Update only the necessary part of the page with the new data
          // Assuming the response contains HTML for the purchased cart table
          document.getElementById('purchasedcartTable').innerHTML = xhr.responseText;
       
        }

        
      };
      xhr.open('GET', url, true);
      xhr.send();
    }

    

    // Function to periodically update the data
    function updateDataPeriodically() {
      getPurchasedCartData(); // Update immediately
      setInterval(getPurchasedCartData, 2000); // Update every 1 second (adjust as needed)
    }

    // Start updating the data
    updateDataPeriodically();