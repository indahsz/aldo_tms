<div class="modal fade" id="upload-stnk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto STNK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="upload-stnk-form">
                    @csrf
                    <input type="hidden" name="id" id="stnk-id">
                    <input type="hidden" name="captured_image" id="stnk-captured-image">

                    <div class="row">
                        <div class="col mb-3 text-center">
                            <label class="form-label">Foto STNK</label>
                            <video id="video-stnk" width="100%" height="300" autoplay></video>
                            <canvas id="canvas-stnk" class="d-none"></canvas>
                            <button type="button" id="capture-stnk" class="btn btn-primary mt-2">Capture</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3 text-center">
                            <img id="preview-stnk" class="img-fluid d-none" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        function setupUploadModal(modalId, videoId, canvasId, captureButtonId, previewId, inputId, formId, buttonClass, uploadUrl) {
            let video = document.getElementById(videoId);
            let canvas = document.getElementById(canvasId);
            let captureButton = document.getElementById(captureButtonId);
            let preview = document.getElementById(previewId);
            let capturedImageInput = document.getElementById(inputId);

            // Open camera when modal is shown
            document.getElementById(modalId).addEventListener("shown.bs.modal", function() {
                navigator.mediaDevices.getUserMedia({
                        video: { facingMode: "environment" }
                    })
                    .then(function(stream) {
                        video.srcObject = stream;
                    })
                    .catch(function(err) {
                        console.error("Error accessing the camera: ", err);
                    });
            });

            // Stop camera when modal is hidden
            document.getElementById(modalId).addEventListener("hidden.bs.modal", function() {
                let stream = video.srcObject;
                if (stream) {
                    let tracks = stream.getTracks();
                    tracks.forEach(track => track.stop());
                    video.srcObject = null;
                }
            });

            // Capture image
            captureButton.addEventListener("click", function() {
                let context = canvas.getContext("2d");
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convert to Base64
                let imageData = canvas.toDataURL("image/png");

                // Show preview
                preview.src = imageData;
                preview.classList.remove("d-none");

                // Store in hidden input field
                capturedImageInput.value = imageData;
            });

            // Set modal form action dynamically
            document.querySelectorAll(buttonClass).forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    let form = document.getElementById(formId);

                    form.action = `${uploadUrl}/${id}`;
                    document.getElementById(inputId.replace('-captured-image', '-id')).value = id;
                });
            });
        }

        // Initialize modals
        setupUploadModal("upload-stnk", "video-stnk", "canvas-stnk", "capture-stnk", "preview-stnk", "stnk-captured-image", "upload-stnk-form", ".upload-stnk-btn", "/bongkar/uploadStnk");
    });
</script>