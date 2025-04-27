window.addEventListener("load", async () => {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");

    // Muat model face-api
    await Promise.all([
        faceapi.nets.faceLandmark68Net.loadFromUri("/cam_js/models"),
        faceapi.nets.tinyFaceDetector.loadFromUri("/cam_js/models"),
        faceapi.nets.faceRecognitionNet.loadFromUri("/cam_js/models"),
    ]);

    // Jalankan kamera
    navigator.mediaDevices
        .getUserMedia({ video: {} })
        .then((stream) => {
            video.srcObject = stream;
            video.onloadedmetadata = () => {
                video.play();

                const displaySize = {
                    width: video.videoWidth,
                    height: video.videoHeight,
                };

                faceapi.matchDimensions(canvas, displaySize);

                // Inisialisasi flag presensi
                window.presensiDicatat = {};

                setInterval(async () => {
                    const detections = await faceapi
                        .detectAllFaces(
                            video,
                            new faceapi.TinyFaceDetectorOptions()
                        )
                        .withFaceLandmarks()
                        .withFaceDescriptors();

                    const resizedDetections = faceapi.resizeResults(
                        detections,
                        displaySize
                    );

                    // Jika tidak ada deteksi wajah, lewati loop
                    if (resizedDetections.length === 0) {
                        console.log("Tidak ada wajah yang terdeteksi");
                        canvas
                            .getContext("2d")
                            .clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
                        return;
                    }

                    // Bersihkan canvas sebelum menggambar
                    canvas
                        .getContext("2d")
                        .clearRect(0, 0, canvas.width, canvas.height);

                    // Ambil gambar dari video sebagai base64
                    function getBase64ImageFromVideo(video) {
                        const tempCanvas = document.createElement("canvas");
                        tempCanvas.width = video.videoWidth;
                        tempCanvas.height = video.videoHeight;
                        const ctx = tempCanvas.getContext("2d");
                        ctx.drawImage(
                            video,
                            0,
                            0,
                            tempCanvas.width,
                            tempCanvas.height
                        );
                        return tempCanvas.toDataURL("image/jpeg"); // hasil base64
                    }

                    const base64Image = getBase64ImageFromVideo(video);

                    const response = await fetch(
                        "http://127.0.0.1:5000/predict",
                        {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                image: base64Image, // kirim field "image"
                            }),
                        }
                    );

                    const result = await response.json(); // hasil dari Flask backend
                    // Bungkus menjadi array jika bukan array
                    const results = Array.isArray(result) ? result : [result];

                    // Sekarang gunakan hasilPrediksi untuk dicek panjangnya
                    if (results.length === resizedDetections.length) {
                        results.forEach(async (prediction, i) => {
                            const label = prediction.label;
                            const confidence = prediction.confidence;
                            const box = resizedDetections[i].detection.box;

                            // Gambar kotak deteksi
                            const drawBox = new faceapi.draw.DrawBox(box, {
                                label: `${label} (${(confidence * 100).toFixed(
                                    2
                                )}%)`, // tampilkan confidence
                            });
                            drawBox.draw(canvas);

                            // Tambahkan validasi confidence di sini
                            if (confidence < 0.85 || label === "unknown") {
                                console.log(
                                    "Wajah tidak dikenali atau confidence rendah:",
                                    confidence
                                );
                                return;
                            }

                            if (
                                label !== "unknown" &&
                                !window.presensiDicatat[label]
                            ) {
                                const nisMatch = label.match(/\((.*?)\)/);
                                if (!nisMatch || !nisMatch[1]) {
                                    console.warn(
                                        "Label tidak sesuai format: ",
                                        label
                                    );
                                    return;
                                }

                                const nis_siswa = nisMatch[1];
                                const now = new Date();
                                const tanggal = now.toISOString().slice(0, 10);
                                const waktu_presensi = now
                                    .toTimeString()
                                    .slice(0, 8);

                                const res = await fetch("/presensi/proses", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .getAttribute("content"),
                                    },
                                    body: JSON.stringify({
                                        nis_siswa,
                                        tanggal,
                                        waktu_presensi,
                                        status: "Hadir",
                                    }),
                                });

                                if (res.ok) {
                                    console.log("Presensi berhasil dicatat");
                                    window.presensiDicatat[label] = true;

                                    document.getElementById(
                                        "namaPresensi"
                                    ).innerText = label;
                                    document
                                        .getElementById("hasilPresensi")
                                        .classList.remove("hidden");

                                    setTimeout(() => {
                                        document
                                            .getElementById("hasilPresensi")
                                            .classList.add("hidden");
                                    }, 5000);
                                } else {
                                    console.error("Gagal mencatat presensi");
                                }
                            }
                        });
                    } else {
                        console.error(
                            "Mismatch antara jumlah hasil deteksi dan hasil prediksi:",
                            {
                                hasilFlask: result,
                                hasilDeteksi: resizedDetections,
                            }
                        );
                    }
                }, 1500);
            };
        })
        .catch((err) => console.error("Error accessing webcam:", err));
});
