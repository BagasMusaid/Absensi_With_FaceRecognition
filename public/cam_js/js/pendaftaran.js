let video = document.getElementById("video");
let canvas = document.getElementById("canvas");
let ctx = canvas.getContext("2d");
let displaySize;

// Mulai kamera
const startSteam = () => {
    navigator.mediaDevices
        .getUserMedia({
            video: true,
            audio: false,
        })
        .then((steam) => {
            video.srcObject = steam;
        });
};

// Load model face-api.js
Promise.all([
    faceapi.nets.ageGenderNet.loadFromUri("/cam_js/models"),
    faceapi.nets.faceLandmark68Net.loadFromUri("/cam_js/models"),
    faceapi.nets.ssdMobilenetv1.loadFromUri("/cam_js/models"),
    faceapi.nets.tinyFaceDetector.loadFromUri("/cam_js/models"),
    faceapi.nets.faceRecognitionNet.loadFromUri("/cam_js/models"),
    faceapi.nets.faceExpressionNet.loadFromUri("/cam_js/models"),
])
    .then(() => {
        console.log("Semua model berhasil dimuat.");
        startSteam();
    })
    .catch((err) => {
        console.error("Gagal memuat model:", err);
    });

// Fungsi deteksi realtime
async function detec() {
    const detections = await faceapi.detectAllFaces(
        video,
        new faceapi.TinyFaceDetectorOptions()
    );
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    const resize = faceapi.resizeResults(detections, displaySize);
    faceapi.draw.drawDetections(canvas, resize);
}

// Atur ukuran canvas
video.addEventListener("play", () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(canvas, displaySize);
    setInterval(detec, 100);
});

// Fungsi registrasi multi-angle
async function registerFace() {
    const NIS = document.getElementById("NIS").value;

    alert(
        "Registrasi akan mengambil 10 sudut wajah. Pastikan wajah jelas di kamera."
    );

    let collectedEmbeddings = [];
    let collectedImages = [];
    const jumlahPengujian = 10;

    for (let i = 0; i < jumlahPengujian; i++) {
        document.getElementById("jumlah-pengujian").innerText = i + 1;

        await Swal.fire({
            title: `Ambil gambar ke- ${i + 1} dari ${jumlahPengujian} gambar`,
            text: "Posisikan wajah dan klik OK",
            icon: "info",
        });

        await new Promise((resolve) => setTimeout(resolve, 3000)); // Tunggu 3 detik

        const detections = await faceapi
            .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptors();

        if (!detections || detections.length === 0) {
            alert("Wajah tidak terdeteksi. Ulangi posisi.");
            i--; // Ulangi posisi
            continue;
        }

        if (detections.length > 1) {
            alert("Lebih dari satu wajah terdeteksi. Ulangi posisi.");
            i--;
            continue;
        }

        const detection = detections[0];
        const descriptor = Array.from(detection.descriptor);
        collectedEmbeddings.push(descriptor);

        // Ambil snapshot wajah
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        //crop wajah
        const box = detection.detection.box;

        // Buat canvas sementara untuk crop
        const cropCanvas = document.createElement("canvas");
        cropCanvas.width = box.width;
        cropCanvas.height = box.height;
        const cropCtx = cropCanvas.getContext("2d");

        // Gambar bagian wajah yang terdeteksi ke canvas crop
        cropCtx.drawImage(
            video,
            box.x,
            box.y,
            box.width,
            box.height,
            0,
            0,
            box.width,
            box.height
        );

        // Ambil hasil crop sebagai base64
        const croppedImage = cropCanvas.toDataURL("image/jpeg");
        collectedImages.push(croppedImage);
    }

    // Kirim ke server Laravel
    try {
        const response = await fetch("/daftar-wajah/simpan-wajah", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                NIS_Siswa: NIS,
                embeddings: collectedEmbeddings,
                face_images: collectedImages,
            }),
        });

        if (response.ok) {
            const data = await response.json();
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: data.message,
            }).then(async () => {
                // Tampilkan loading saat mulai training
                document.getElementById("loading").style.display = "block";

                try {
                    const trainResponse = await fetch(
                        "/daftar-wajah/train-model"
                    );

                    if (!trainResponse.ok) {
                        throw new Error("Training gagal");
                    }

                    const trainData = await trainResponse.json();
                    console.log("Training berhasil:", trainData.message);

                    // Sembunyikan loading
                    document.getElementById("loading").style.display = "none";

                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Training",
                        text: "Berhasil Melakukan Training Wajah",
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } catch (err) {
                    console.error("Gagal training model:", err);

                    document.getElementById("loading").style.display = "none";

                    Swal.fire({
                        icon: "error",
                        title: "Gagal Training!",
                        text: "Model gagal dilatih. Tapi wajah tetap tersimpan.",
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                }
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Gagal menyimpan!",
                text: "Terjadi kesalahan saat menyimpan wajah.",
            });
        }
    } catch (error) {
        console.error("Gagal menyimpan wajah:", error);
        alert("Terjadi kesalahan saat menyimpan wajah. Lihat console.");
    }
}
