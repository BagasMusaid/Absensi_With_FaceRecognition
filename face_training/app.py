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

        # Resize dan normalisasi
        img = img.resize((160, 160))
        img_array = image.img_to_array(img) / 255.0
        img_array = np.expand_dims(img_array, axis=0)  # (1, 160, 160, 3)

        # Prediksi
        prediction = model.predict(img_array)[0]
        max_index = np.argmax(prediction)
        confidence = float(prediction[max_index])
        print({class_names[i]: float(prediction[i]) for i in range(len(class_names))})

# Logging untuk bantu debug
        app.logger.info(f"Prediksi: {class_names[max_index]}, Confidence: {confidence:.4f}")

# Threshold yang lebih tinggi (disarankan 0.95 atau lebih)
        if confidence > 0.80:
            label = class_names[max_index]
        else:
            label = "unknown"


        return jsonify({
            "label": label,
            "confidence": confidence
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500


if __name__ == "__main__":
    app.run(port=5000)
