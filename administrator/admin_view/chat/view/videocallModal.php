<div class="modal" id="videoCallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Call Modal</h5>
                <button type="button" class="close leaveCallBtn"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="video-container" id="videoContainerForUser1">
                    <!-- Camera feed for User 1 will be displayed here -->
                    <img src="../../upload_system/empty.png" alt="Default Image User 1" id="imageuser1">
                </div>
                <div class="video-container" id="videoContainerForUser2">
                    <!-- Default image for User 2 will be displayed here -->
                    <img src="../../upload_system/empty.png" alt="Default Image User 2" id="imageuser2">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary leaveCallBtn">Leave Call</button>
                
                <button type="button" class="btn btn-secondary" id="cameraButton" onclick="toggleCamera()">
                <i class="fa fa-video-slash" style="margin-right: 5px;"></i> 
                </button>

                <button type="button" class="btn btn-secondary" id="micButton" onclick="toggleMic()">
                <i class="fa fa-microphone-slash" style="margin-right: 5px;"></i> 
                </button>

            </div>

            
        </div>
    </div>
</div>
