function updateDateTime() {
    const now = new Date();
    
    // Determine greeting
    const hours = now.getHours();
    let greeting;
    
    if (hours >= 6 && hours < 12) {
        greeting = 'Good Morning';
    } else if (hours >= 12 && hours < 18) {
        greeting = 'Good Afternoon';
    } else {
        greeting = 'Good Evening';
    }
    
    // Determine greeting icon visibility
    document.getElementById('gmorning').hidden = !(hours >= 6 && hours < 12);
    document.getElementById('gafternoon').hidden = !(hours >= 12 && hours < 18);
    document.getElementById('gevening').hidden = !(hours >= 18 || hours < 6);
    
    // Format time
    let displayHours = hours % 12;
    displayHours = displayHours ? displayHours : 12; // the hour '0' should be '12'
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'pm' : 'am';
    const timeString = `${displayHours}:${minutes}${ampm}`;
    
    // Format date
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString(undefined, options);
    
    // Update HTML elements
    document.getElementById('time').innerText = timeString;
    document.getElementById('date').innerText = dateString;
    document.getElementById('greeting').innerText = greeting;
}

// Initial call to set the time and date immediately
updateDateTime();

// Update time and date every second
setInterval(updateDateTime, 1000);
