let video = document.getElementById("video");
let canvas = document.getElementById("canvas");
let ctx = canvas.getContext("2d");
let displaySize;

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

Promise.all([
    faceapi.nets.ageGenderNet.loadFromUri("/cam_js/models"),
    faceapi.nets.faceLandmark68Net.loadFromUri("/cam_js/models"),
    faceapi.nets.ssdMobilenetv1.loadFromUri("/cam_js/models"),
    faceapi.nets.tinyFaceDetector.loadFromUri("/cam_js/models"),
    faceapi.nets.faceRecognitionNet.loadFromUri("/cam_js/models"),
    faceapi.nets.faceExpressionNet.loadFromUri("/cam_js/models"),
]).then(startSteam);

async function detec() {
    const detections = await faceapi.detectAllFaces(video);
    console.log(detections);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    const resize = faceapi.resizeResults(detections, displaySize);
    faceapi.draw.drawDetections(canvas, resize);
}

video.addEventListener("play", () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(canvas, displaySize);
    setInterval(detec, 100);
});
