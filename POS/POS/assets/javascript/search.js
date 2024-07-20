const searchInput = document.getElementById('search');
const suggestionsDiv = document.getElementById('suggestions');
const productDetailsDiv = document.getElementById('productDetails');

searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value;
    if (searchTerm.length > 0) {
        fetch(`search.php?term=${searchTerm}`)
            .then(response => response.json())
            .then(data => {
                suggestionsDiv.innerHTML = '';
                const suggestionsToShow = data.slice(0, 5); // Limit to 10 suggestions
                suggestionsToShow.forEach(suggestion => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.classList.add('suggestion');
                    suggestionItem.textContent = suggestion;
                    suggestionsDiv.appendChild(suggestionItem);

                    suggestionItem.addEventListener('click', function() {
                        searchInput.value = suggestion; // Insert suggestion into input
                        suggestionsDiv.innerHTML = ''; // Clear suggestions
                        showProductDetails(suggestion);
                    });

                    suggestionItem.addEventListener('mouseover', function() {
                        suggestionItem.classList.add('hovered');
                    });

                    suggestionItem.addEventListener('mouseout', function() {
                        suggestionItem.classList.remove('hovered');
                    });
                });
            });
    } else {
        suggestionsDiv.innerHTML = '';
        productDetailsDiv.innerHTML = '';
    }
});

function showProductDetails(productName) {
    fetch(`get_product_details.php?name=${productName}`)
        .then(response => response.json())
        .then(data => {
            const productDetails = data.details; // Assuming the JSON response structure
            productDetailsDiv.innerHTML = `
                <h2>${productDetails.name}</h2>
                <p>Status: ${productDetails.status}</p>
            `;
        });
}

searchInput.addEventListener('blur', function() {
    if (searchInput.value) {
        // Simulate "Enter" key press
        const enterKeyEvent = new KeyboardEvent('keydown', {
            key: 'Enter',
            keyCode: 13,
            bubbles: true,
            cancelable: true
        });

        searchInput.dispatchEvent(enterKeyEvent);
    }
});
