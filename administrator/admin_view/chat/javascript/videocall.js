var cameraStatus = true;
var micStatus = true;

function toggleCamera() {
  var cameraButton = document.getElementById("cameraButton");
  if (cameraStatus) {
    cameraButton.innerHTML = '<i class="fa fa-video" style="margin-right: 5px;"></i>';
  } else {
    cameraButton.innerHTML = '<i class="fa fa-video-slash" style="margin-right: 5px;"></i>';
  }
  cameraStatus = !cameraStatus;
}

function toggleMic() {
  var micButton = document.getElementById("micButton");
  if (micStatus) {
    micButton.innerHTML = '<i class="fa fa-microphone" style="margin-right: 5px;"></i>';
  } else {
    micButton.innerHTML = '<i class="fa fa-microphone-slash" style="margin-right: 5px;"></i>';
  }
  micStatus = !micStatus;
}




document.addEventListener('DOMContentLoaded', function() {
    $('#videoCallModal').on('shown.bs.modal', function () {
        var recieverImageSrc = $('#reciever_image').attr('src');
        $('#imageuser2').attr('src', recieverImageSrc);

        var userImageSrc = $('#userImage').attr('src');
        $('#imageuser1').attr('src', userImageSrc);
    });
});

$(document).ready(function() {
    let isCallActive = false;

    $('#videoCallModal').on('hide.bs.modal', function(event) {
        if (isCallActive) {
            if (!confirm("Are you sure you want to leave the call?")) {
                event.preventDefault();
                $('#videoCallModal').modal('show');
            }
        }
    });

    $('.leaveCallBtn').click(function() {
        if (confirm("Are you sure you want to leave the call?")) {
            isCallActive = false;
            $('#videoCallModal').modal('hide');
        }
    });

    $('#videoCallLink').click(function(e) {
        e.preventDefault();
        $('#videoCallModal').modal('show');
        isCallActive = true;
    });
});
