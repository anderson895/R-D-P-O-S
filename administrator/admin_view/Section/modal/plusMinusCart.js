
var inputElement = document.querySelector('.toglerQtyRequest');
var sendButton = document.getElementById('sendRequestTogler');
var firstInput = true;

inputElement.addEventListener('input', function() {
    var currentValue = this.value.replace(/^0+/, ''); // Alisin ang mga leading zeros

    if (currentValue === '') {
        currentValue = '0'; // Kung wala nang natira, ituring itong 0
    }

    this.value = currentValue;

    if (isNaN(currentValue) || currentValue <= 0) {
        sendButton.disabled = true;
    } else {
        sendButton.disabled = false;

        if (firstInput && currentValue !== '0') {
            firstInput = false;
            inputElement.value = currentValue;
        }
    }
});

function increaseValue() {
    var currentValue = parseInt(inputElement.value);
    inputElement.value = currentValue + 1;
    checkInputValue();
}

function decreaseValue() {
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
    }
    checkInputValue();
}

function checkInputValue() {
    var currentValue = parseInt(inputElement.value.replace(/^0+/, ''));

    if (isNaN(currentValue) || currentValue <= 0) {
        sendButton.disabled = true;
    } else {
        sendButton.disabled = false;

        if (firstInput && currentValue !== 0) {
            firstInput = false;
            inputElement.value = currentValue;
        }
    }
}