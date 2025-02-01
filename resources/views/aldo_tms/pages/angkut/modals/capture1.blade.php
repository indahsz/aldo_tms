<div class="modal fade" id="captureModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Capture Photo 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="video1" class="video-capture" width="320" height="240" autoplay></video>
                <canvas id="canvas1" class="canvas-capture" style="display:none;"></canvas>
                <br>
                <button type="button" id="capture1" class="btn btn-secondary" data-capture-id="1">Capture</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>