   // Function to take a snapshot from the video stream
         // Access the webcam
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const hidden = document.getElementById('selfie_data');
        const preview = document.getElementById('preview');
        const select = document.getElementById('cameraSelect');
        let currentStream;

        async function listCameras() {
            const devices = await navigator.mediaDevices.enumerateDevices();
            const cameras = devices.filter(d => d.kind === 'videoinput');

            select.innerHTML = '';

            cameras.forEach(cam => {
                const option = document.createElement('option');
                option.value = cam.deviceId;
                option.text = cam.label || `Camera ${select.length + 1}`;
                select.appendChild(option);
            });
        }

        async function startStream(deviceId) {
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
            }

            const constraints = {
                video: { deviceId: { exact: deviceId } }
            };

            currentStream = await navigator.mediaDevices.getUserMedia(constraints);
            video.srcObject = currentStream;
        }

        select.addEventListener('change', () => {
            startStream(select.value);
        });

        window.takeSnapshot = function () {
            console.log("Button clicked!");
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            hidden.value = imageData;

            preview.src = imageData;
            preview.style.display = 'block';
            canvas.style.display = 'block';
        };

        // Run on load
        (async () => {
            await listCameras();
            if (select.options.length > 0) {
                await startStream(select.value);
            } else {
                alert("No camera found.");
            }
        })();
 