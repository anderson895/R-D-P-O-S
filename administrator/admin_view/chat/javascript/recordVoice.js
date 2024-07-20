$(document).ready(function() {



    let mediaRecorder;
    let chunks = [];
    let timerInterval;
    let startTime;
    let pausedAt;

    function formatTime(timeInSeconds) {
        const minutes = Math.floor(timeInSeconds / 60);
        const seconds = timeInSeconds % 60;
        return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }

    function clearRecording() {
        chunks = [];
    
        $("#recordedAudio").attr('src', '');
        $("#recordedAudio").hide();
        $("#deleteButton").hide();
        $("#sendVoice").hide();
    }

    $("#startButton").click(function() {
        clearRecording();
        $("#sendButton").hide();
        $("#messageInput").hide();



        $("#sendVoice").show(); 
       // console.log("#sendVoice")


        $("#recordingDuration").show();
        $("#deleteButton").hide();
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(function(stream) {
                mediaRecorder = new MediaRecorder(stream);
                startTime = new Date() - (pausedAt || 0);

                $("#recordingStatus").show();
                $("#startButton").hide();
                $("#pauseButton").show();
                $("#stopButton").show();
                $("#duration").show();

                timerInterval = setInterval(function() {
                    var currentTime = new Date();
                    var duration = Math.round((currentTime - startTime) / 1000);
                    $("#duration").val(formatTime(duration));




                }, 1000);

                mediaRecorder.ondataavailable = function(e) {
                    chunks.push(e.data);
                };

                mediaRecorder.onstop = function() {
                    clearInterval(timerInterval);
                    var audioBlob = new Blob(chunks, { 'type' : 'audio/wav' });
        
                    var audioUrl = URL.createObjectURL(audioBlob);
                    $("#recordedAudio").attr('src', audioUrl);
                    $("#recordedAudio").show();
                    $("#deleteButton").show();
                    $("#sendVoice").show();
                };

                mediaRecorder.start();
            })
            .catch(function(err) {
                console.error('Error: ' + err);
            });
    });

    $("#pauseButton").click(function() {
        mediaRecorder.pause();
        clearInterval(timerInterval);
        pausedAt = new Date() - startTime;
        $("#recordingStatus").text("Paused");
        $("#pauseButton").hide();
        $("#continueButton").show();
    });

    $("#continueButton").click(function() {
        mediaRecorder.resume();
        startTime = new Date() - pausedAt;
        pausedAt = null;
        $("#recordingStatus").text("Recording...");
        $("#pauseButton").show();
        $("#continueButton").hide();
        timerInterval = setInterval(function() {
            var currentTime = new Date();
            var duration = Math.round((currentTime - startTime) / 1000);
            $("#duration").text(formatTime(duration));
        }, 1000);
    });

    $("#stopButton").click(function() {
        mediaRecorder.stop();
        $("#recordingStatus").text("Recording stopped");
        clearInterval(timerInterval);
        $("#pauseButton").hide();
        $("#continueButton").hide();
        $("#startButton").show();
        $("#recordingDuration").hide();
        $("#stopButton").hide();
        $("#sendVoice").show();
        $("#sendVoice").prop("disabled", false);
    });

    $("#deleteButton").click(function() {
        clearRecording();
        $("#sendButton").show();
        $("#messageInput").show();
        

        $("#sendVoice").hide();
        $("#duration").hide();




    });

    $("#sendVoice").click(function() {
        // Get the account_id from the URL
        const urlParams = new URLSearchParams(window.location.search);
        var account_id = urlParams.get('account_id');
    
        var audioBlob = new Blob(chunks, { 'type' : 'audio/wav' });
        var formData = new FormData();
        formData.append('audio', audioBlob, 'recorded_audio.wav');
        formData.append('account_id', account_id);
    
        $.ajax({
            url: 'chat/controller/save_audio.php', // Update the URL as per your server endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Recorded audio successfully sent to server.');
    
                console.log(response);
    
                $("#sendButton").show();
                $("#messageInput").show();
                $("#sendVoice").hide();
                $("#duration").hide();
                clearRecording();
                // Handle any response from the server
            },
            error: function(xhr, status, error) {
                console.error('Error sending audio to server:', error);
                // Handle the error here
            }
        });
    });

    
    
});