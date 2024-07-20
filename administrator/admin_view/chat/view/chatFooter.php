<div class="card-footer">
    <div class="input-group">
        <div class="input-group-prepend">
            <label for="fileInput" class="btn btn-primary">
                <i class="fa fa-paperclip"></i> &nbsp;
            </label>
            <input type="file" id="fileInput" class="form-control-file" style="display: none;">
        </div>

        <input style="display:block;" class="form-control type_msg mh-auto empty_check" id="messageInput" placeholder="Type your message...">
        <div id="loadingSpinner"></div>
        <button disabled class="btn btn-primary btn_send" id="sendButton">
            <i class="fa fa-paper-plane" aria-hidden="true" id="sendIcon"></i> Send
        </button>
    </div>
    <div id="fileDisplay" style="display: none;">
        <span id="fileName">Selected File: </span>
        <button id="removeFile" class="btn btn-danger">X</button>
    </div>
</div>
