function showDiv() {
    var purchaseMethod = document.getElementById("purchaseMethod").value;
    var posDiv = document.getElementById("posDiv");
    var onlineDiv = document.getElementById("onlineDiv");

    if (purchaseMethod === "pos") {
        if (posDiv) {
            posDiv.style.display = "block";
        }
        if (onlineDiv) {
            onlineDiv.style.display = "none";
        }
    } else if (purchaseMethod === "online") {
        if (posDiv) {
            posDiv.style.display = "none";
        }
        if (onlineDiv) {
            onlineDiv.style.display = "block";
        }
    } else {
        if (posDiv) {
            posDiv.style.display = "none";
        }
        if (onlineDiv) {
            onlineDiv.style.display = "none";
        }
    }
}

$(document).ready(function () {
    $('#example').DataTable();
    $('#example1').DataTable();
});

function redirectToDirectory(orderCode) {
    window.location.href = "receipt.php?RDcode=" + orderCode;
  }