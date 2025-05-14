<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkin Planet Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #videoElement {
            width: 100%;
            height: 50%;
            border: 2px solid #000;
        }
        body{
            background-color: #328E6E;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <video id="videoElement" autoplay></video>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Check-in Berhasil!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silahkan menggunakan lapangan.
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">QR Tidak Valid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    QR sudah digunakan atau tidak valid.
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notFoundModal" tabindex="-1" aria-labelledby="notFoundModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="notFoundModalLabel">Booking Code Tidak Ditemukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Kami tidak dapat menemukan booking code ini.
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let video = document.getElementById('videoElement');
        let canScan = true;

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.log("Gagal mengakses kamera!", error);
                });
        }

        function scanQRCode() {
            if (!canScan) return;

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, canvas.width, canvas.height);

            if (code) {
                const bookingCode = code.data;
                console.log("QR Code decoded:", bookingCode);
                checkBookingStatus(bookingCode);
                canScan = false; 

                setTimeout(() => {
                    canScan = true;
                }, 5000);
            }
        }

        function checkBookingStatus(bookingCode) {
            fetch(`/api/checkin/${bookingCode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === 'pending') {
                            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        } else if (data.status === 'done') {
                            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                            errorModal.show();
                        }
                    } else {
                        const notFoundModal = new bootstrap.Modal(document.getElementById('notFoundModal'));
                        notFoundModal.show();
                    }

                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
                        if (modal) modal.hide();
                    }, 5000);
                })
                .catch(error => {
                    console.log("Error checking booking status", error);
                    const notFoundModal = new bootstrap.Modal(document.getElementById('notFoundModal'));
                    notFoundModal.show();

                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
                        if (modal) modal.hide();
                    }, 5000);
                });
        }

        setInterval(scanQRCode, 1000);
    </script>

</body>
</html>
