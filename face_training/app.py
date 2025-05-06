from flask import Flask, request, jsonify
import numpy as np
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
import json
from PIL import Image
import io
import base64
from flask_cors import CORS
import logging
import face_recognition

app = Flask(__name__)
CORS(app)
app.logger.setLevel(logging.INFO)

# Load model CNN dan label encoder
model = load_model("face_training/face_model.h5")  # Ini model yang kamu latih dari gambar

# Load label dari file
with open("face_training/label_encoder.json", "r") as f:
    class_names = json.load(f)

@app.route("/predict", methods=["POST"])
def predict():
    try:
        data = request.get_json()
        img_data = data.get("image")

        if not img_data:
            return jsonify({"error": "Image data not found"}), 400

        # Decode base64 ke image
        img_bytes = base64.b64decode(img_data.split(',')[1])
        img = Image.open(io.BytesIO(img_bytes)).convert("RGB")

        # Deteksi wajah dengan face_recognition
        img_array = np.array(img)
        face_locations = face_recognition.face_locations(img_array)
        
        if len(face_locations) == 0:
            return jsonify({"error": "No faces detected"}), 400
        
        # Logging lokasi wajah yang terdeteksi
        app.logger.info(f"Detected faces: {face_locations}")


        # Untuk setiap wajah yang terdeteksi, ekstrak dan lakukan prediksi
        results = []
        for idx, face_location in enumerate(face_locations):
            top, right, bottom, left = face_location

            # Potong wajah dari gambar
            face_img = img_array[top:bottom, left:right]
            face_img = Image.fromarray(face_img)
            face_img = face_img.resize((160, 160))
            face_array = image.img_to_array(face_img) / 255.0
            face_array = np.expand_dims(face_array, axis=0)

            # Prediksi untuk wajah ini
            prediction = model.predict(face_array)[0]
            max_index = np.argmax(prediction)
            confidence = float(prediction[max_index])

            print({class_names[i]: float(prediction[i]) for i in range(len(class_names))})

            # Logging untuk bantu debug
            app.logger.info(f"Prediksi: {class_names[max_index]}, Confidence: {confidence:.4f}")
            app.logger.info(f"Face {idx+1} - Prediksi: {class_names[max_index]}, Confidence: {confidence:.4f}")

            # Tentukan label berdasarkan confidence
            if confidence > 0.80:
                label = class_names[max_index]
            else:
                label = "unknown"

            # Tambahkan hasil prediksi
            results.append({
                "label": label,
                "confidence": confidence,
                "location": face_location  # Posisi wajah di gambar
            })

        return jsonify(results)

    except Exception as e:
        return jsonify({"error": str(e)}), 500


if __name__ == "__main__":
    app.run(port=5000)
