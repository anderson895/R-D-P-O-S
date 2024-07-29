document.addEventListener('DOMContentLoaded', () => {
    const viewUpload = document.getElementById('viewUpload');

    viewUpload.addEventListener('click', () => {
        const img = document.getElementById('uploadedImage');

        if (img.requestFullscreen) {
            img.requestFullscreen();
        } else if (img.mozRequestFullScreen) { // Firefox
            img.mozRequestFullScreen();
        } else if (img.webkitRequestFullscreen) { // Chrome, Safari and Opera
            img.webkitRequestFullscreen();
        } else if (img.msRequestFullscreen) { // IE/Edge
            img.msRequestFullscreen();
        }
    });

    // Optional: Add a key listener to exit fullscreen
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // IE/Edge
                document.msExitFullscreen();
            }
        }
    });
});