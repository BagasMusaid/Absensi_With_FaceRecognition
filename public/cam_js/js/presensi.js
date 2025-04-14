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
            video.onloadedmetadata = async () => {
                video.play();

                const displaySize = {
                    width: video.videoWidth,
                    height: video.videoHeight,
                };

                faceapi.matchDimensions(canvas, displaySize);

                // Load embeddings
                const labeledDescriptors = await loadLabeledImages();
                const faceMatcher = new faceapi.FaceMatcher(
                    labeledDescriptors,
                    0.6
                );

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

                    canvas
                        .getContext("2d")
                        .clearRect(0, 0, canvas.width, canvas.height);

                    const results = resizedDetections.map((d) =>
                        faceMatcher.findBestMatch(d.descriptor)
                    );

                    results.forEach(async (result, i) => {
                        const label = result.label;

                        const box = resizedDetections[i].detection.box;
                        const drawBox = new faceapi.draw.DrawBox(box, {
                            label,
                        });
                        drawBox.draw(canvas);

                        if (
                            label !== "unknown" &&
                            !window.presensiDicatat[label]
                        ) {
                            const nis_siswa = label.match(/\((.*?)\)/)[1]; // Ambil NIS dari label
                            const now = new Date();
                            const tanggal = now.toISOString().slice(0, 10); // yyyy-mm-dd
                            const waktu_presensi = now
                                .toTimeString()
                                .slice(0, 8); // hh:mm:ss

                            // Simpan presensi
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

                                // Tampilkan ke UI
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
                }, 1500);
            };
        })
        .catch((err) => console.error("Error accessing webcam:", err));

    // Fungsi load data embedding
    async function loadLabeledImages() {
        const response = await fetch("/daftar-wajah/json");
        const data = await response.json();
        const labelMap = {};
        data.forEach((item) => {
            const label = `${item.nama_siswa} (${item.NIS_Siswa})`;
            if (!labelMap[label]) {
                labelMap[label] = [];
            }
            labelMap[label].push(new Float32Array(item.embedding));
        });

        return Object.entries(labelMap).map(
            ([label, descriptors]) =>
                new faceapi.LabeledFaceDescriptors(label, descriptors)
        );
    }
});
