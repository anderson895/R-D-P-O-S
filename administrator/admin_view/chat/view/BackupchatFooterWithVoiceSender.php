
    <div class="card-footer">
    <div class="input-group">
        <div class="input-group-append">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus-circle"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">
                    <label for="fileInput" class="custom-file-upload">
                        <i class="fa fa-paperclip"></i> Attach File
                    </label>
                    <input type="file" id="fileInput" class="form-control-file" style="display: none;">
                </a>
                <a id="startButton" class="dropdown-item" href="#">
                    <i class="fa fa-microphone" style="margin-right: 5px;"></i>
                    Voice message
                </a>
                
                <a class="dropdown-item" href="#" style="display: flex; align-items: center;" id="videoCallLink">
                    <i class="fa fa-video" style="margin-right: 5px;"></i>
                    Video 
                </a>


            </div>
        </div>


        <input style="display:block;" class="form-control type_msg mh-auto empty_check" id="messageInput" placeholder="Type your message...">
        <button disabled class="btn btn-primary btn_send" id="sendButton"><i class="fa fa-paper-plane" aria-hidden="true" id="sendIcon"></i>Send message</button>


        <input style="display:none;" class="form-control type_msg mh-auto empty_check" id="duration" value="0:00" ><!-- for display purposes--->

        <button disabled style="display:none;" class="btn btn-primary btn_send" id="sendVoice"><i class="fa fa-paper-plane" aria-hidden="true" id="sendIcon"></i>Send voice</button>
    </div>
    <div id="fileDisplay" style="display: none;">
        <span id="fileName">Selected File: </span>
        <button id="removeFile" class="btn btn-danger">X</button>
    </div>

   <!--- <div style="display: none;" id="recordingDuration"> id=deleteButton
        Recording duration: <span id="duration">0:00</span>
    </div>--->

    
    <button style="display:none;" id="pauseButton" class="btn btn-secondary"><i class="fas fa-pause"></i> Pause Recording</button>
    <button style="display:none;" id="stopButton" class="btn btn-danger"><i class="fas fa-stop"></i> stop Recording</button>
    <button style="display:none;" id="continueButton" class="btn btn-success"><i class="fas fa-play"></i> Continue</button>
    <i id="deleteButton" style="display:none;" class="far fa-times-circle text-danger" style="font-size: 48px;"></i>


    <audio controls id="recordedAudio" style="display: none;"></audio>




   
</div>
