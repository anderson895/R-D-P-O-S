/*
  function addStockToTable() {
    const supplierNameModal = document.getElementById('supplierNameModal').value;
    const productName = document.getElementById('productNameModal').value;
    const quantity = parseInt(document.getElementById('quantity').value, 10);
    const purchasePrice = parseFloat(document.getElementById('purchasePrice').value);
    const expirationOption = document.querySelector('input[name="expirationOption"]:checked');
    const expirationDate = expirationOption && expirationOption.value === 'withExpiration' ? document.getElementById('expirationDate').value : 'No Expiration';
    const discount = parseFloat(document.getElementById('discount').value);
    const tax = parseFloat(document.getElementById('tax').value);

    // Compute tax amount and total cost
    const taxAmount = ((purchasePrice * quantity) * (tax / 100));
    const totalCost = (quantity * purchasePrice) + taxAmount - discount;

    const purchasedCart = document.getElementById('purchasedCart');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <a href="javascript:void(0);">${supplierNameModal}</a>
        </td>

      <td class="productimgname">
        <a class="product-img">
          <img src="assets/img/product/product7.jpg" alt="product">
        </a>
        <a href="javascript:void(0);">${productName}</a>
      </td>
      <td>${quantity}</td>
      <td>${purchasePrice}</td>
      <td>${expirationDate}</td>
      <td>${discount}</td>
      <td>${tax}</td>
      <td class="text-end">${taxAmount.toFixed(2)}</td>
      <td class="text-end">${totalCost.toFixed(2)}</td>
      <td>
        <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
      </td>
    `;

    purchasedCart.appendChild(newRow);
  }

  // Assuming you have a button to trigger the addition of stocks
  const addButton = document.getElementById('addStockButton');
  addButton.addEventListener('click', addStockToTable);
*/