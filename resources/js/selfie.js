document.addEventListener('DOMContentLoaded', () => {
    const video      = document.getElementById('video');
    const canvas     = document.getElementById('canvas');
    const preview    = document.getElementById('preview');
    const hidden     = document.getElementById('selfie_data');
    const captureBtn = document.getElementById('captureBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    let currentStream = null;
    let isCapturing = false;

    async function getPreferredCameraId() {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const cameras = devices.filter(d => d.kind === 'videoinput');

        // Prioritize integrated camera by checking its label
        for (let cam of cameras) {
            const label = cam.label.toLowerCase();
            const isIntegrated =
                label.includes("integrated") ||
                label.includes("built-in") ||
                label.includes("hd webcam") ||
                label.includes("facetime") ||
                label.includes("laptop");

            const isNotVirtual = !label.includes("eos") && !label.includes("virtual");

            if (isIntegrated && isNotVirtual) {
                return cam.deviceId;
            }
        }

        // Fallback to the first available camera
        return cameras.length ? cameras[0].deviceId : null;
    }

    async function startCamera() {
        if (currentStream) currentStream.getTracks().forEach(t => t.stop());

        const deviceId = await getPreferredCameraId();

        if (!deviceId) {
            alert("No camera available.");
            return;
        }

        currentStream = await navigator.mediaDevices.getUserMedia({
            video: { deviceId: { exact: deviceId } }
        });

        video.srcObject = currentStream;
        video.style.display = 'block';
    }

    function takePhoto() {
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataUrl = canvas.toDataURL('image/png');

        hidden.value = dataUrl;
        preview.src = dataUrl;
        preview.style.display = 'block';

        if (currentStream) currentStream.getTracks().forEach(t => t.stop());
        video.style.display = 'none';

        captureBtn.textContent = 'Capture Selfie';
        isCapturing = false;
    }

    captureBtn.addEventListener('click', async () => {
        if (!isCapturing) {
            await startCamera();
            captureBtn.textContent = 'Take Photo';
            isCapturing = true;
        } else {
            takePhoto();
        }
    });
        cancelBtn.addEventListener('click', () => {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
        }

        video.style.display = 'none';
        preview.style.display = 'none';
        captureBtn.textContent = 'Capture Selfie';
        isCapturing = false;
        cancelBtn.style.display = 'none';
    });
});