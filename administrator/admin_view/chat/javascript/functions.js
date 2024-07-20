// Function to format time
function formatTime(messageDate) {
    var currentDate = new Date();
    var timeDifference = currentDate - messageDate;
    var secondsAgo = Math.floor(timeDifference / 1000);
    var minutesAgo = Math.floor(secondsAgo / 60);
    var hoursAgo = Math.floor(minutesAgo / 60);
    var daysAgo = Math.floor(hoursAgo / 24);
    var yearsAgo = Math.floor(daysAgo / 365);

    if (yearsAgo > 0) {
        return yearsAgo + " year" + (yearsAgo > 1 ? "s" : "") + " ago";
    } else if (daysAgo > 0) {
        return daysAgo + " day" + (daysAgo > 1 ? "s" : "") + " ago";
    } else if (hoursAgo > 0) {
        return hoursAgo + " hour" + (hoursAgo > 1 ? "s" : "") + " ago";
    } else if (minutesAgo > 0) {
        return minutesAgo + " minute" + (minutesAgo > 1 ? "s" : "") + " ago";
    } else {
        return "Just now";
    }
}


function formatTimeTo12HourFormat(dateTimeString) {
    var date = new Date(dateTimeString);
    
    // Get hours and minutes
    var hours = date.getHours();
    var minutes = date.getMinutes();
    
    // Determine AM or PM
    var amOrPm = hours >= 12 ? 'PM' : 'AM';
    
    // Convert to 12-hour format
    hours = hours % 12 || 12;
    
    // Add leading zeros to minutes if less than 10
    minutes = (minutes < 10 ? '0' : '') + minutes;

    var formattedTime = hours + ':' + minutes + ' ' + amOrPm;

    return formattedTime;
}

