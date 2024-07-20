// Get the modal and the button
const modal = document.getElementById("myModal");
const btn = document.getElementById("openModalBtn");
const closeBtn = document.querySelector(".close");

// When the button is clicked, show or hide the modal based on its current state
btn.addEventListener("click", () => {
    if (modal.style.display === "block") {
        modal.style.display = "none"; // Close the modal
    } else {
        modal.style.display = "block"; // Show the modal
    }
});

// When the close button in the modal is clicked, hide the modal
closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// When the user clicks outside the modal, close it
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});