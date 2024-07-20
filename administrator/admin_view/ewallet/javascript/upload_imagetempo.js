$(document).ready(function() {
    // Event listener for file input
    $('#profilePicture').on('change', function(e) {
        // Get the selected file
        var file = e.target.files[0];

        // Check if a file is selected
        if (file) {
            var reader = new FileReader();

            // Set up the reader to load the image
            reader.onload = function(e) {
                // Create an image element
                var img = new Image();
                img.src = e.target.result;

                // Set a maximum width and height for the displayed image
                var maxWidth = 200;  // Adjust this value as needed
                var maxHeight = 200;  // Adjust this value as needed

                // Resize the image proportionally
                img.onload = function() {
                    var width = img.width;
                    var height = img.height;

                    var newWidth, newHeight;

                    // Calculate new dimensions while maintaining aspect ratio
                    if (width > height) {
                        newWidth = maxWidth;
                        newHeight = Math.round((maxWidth / width) * height);
                    } else {
                        newHeight = maxHeight;
                        newWidth = Math.round((maxHeight / height) * width);
                    }

                    // Set the image dimensions
                    $('.image-uploads img').attr('src', e.target.result).css({
                        'width': newWidth + 'px',
                        'height': newHeight + 'px'
                    });

                    $('.image-uploads h4').text('File selected');
                };
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
});