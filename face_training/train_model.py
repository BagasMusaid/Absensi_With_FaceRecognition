import os
import json
import numpy as np
from tensorflow.keras.models import Model
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Dropout, Flatten, Dense, Input
from tensorflow.keras.applications import MobileNetV2
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.optimizers import Adam
from sklearn.metrics import classification_report, confusion_matrix

# ========== Konfigurasi Path ==========
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DATASET_DIR = os.path.join(BASE_DIR, "public", "storage", "face-labels")
SISWA_JSON = os.path.join(BASE_DIR, "face_training", "siswa.json")
ENCODER_PATH = os.path.join(BASE_DIR, "face_training", "label_encoder.json")
MODEL_PATH = os.path.join(BASE_DIR, "face_training", "face_model.h5")

# ========== Hapus Model Lama ==========
if os.path.exists(MODEL_PATH):
    os.remove(MODEL_PATH)
    print("Model lama dihapus.")

if os.path.exists(ENCODER_PATH):
    os.remove(ENCODER_PATH)
    print("Label encoder lama dihapus.")

# ========== ImageDataGenerator ==========
datagen = ImageDataGenerator(
    rescale=1./255,
    validation_split=0.2,
    rotation_range=15,
    width_shift_range=0.1,
    height_shift_range=0.1,
    zoom_range=0.1,
    horizontal_flip=True,
    shear_range=0.2,
    brightness_range=[0.8, 1.2],
)

train_gen = datagen.flow_from_directory(
    DATASET_DIR,
    target_size=(160, 160),
    batch_size=16,
    class_mode='categorical',
    subset='training',
    shuffle=True
)

val_gen = datagen.flow_from_directory(
    DATASET_DIR,
    target_size=(160, 160),
    batch_size=16,
    class_mode='categorical',
    subset='validation',
    shuffle=True
)

# ========== Simpan Label Encoder ==========
nis_list = list(train_gen.class_indices.keys())
encoded_labels = [None] * len(train_gen.class_indices)

try:
    with open(SISWA_JSON, "r") as f:
        siswa_map = json.load(f)
except Exception as e:
    print(f"Error saat membaca siswa.json: {e}")
    siswa_map = {}

for label, index in train_gen.class_indices.items():
    nama = siswa_map.get(label, "Unknown")
    encoded_labels[index] = f"{nama} ({label})"

try:
    with open(ENCODER_PATH, "w") as f:
        json.dump(encoded_labels, f)
    print("Label encoder berhasil disimpan.")
except Exception as e:
    print(f"Error saat menyimpan label encoder: {e}")

print("Label yang digunakan:")
for i, label in enumerate(encoded_labels):
    print(f"{i}: {label}")

# ========== Bangun Model MobileNetV2 + Custom Head ==========
num_classes = train_gen.num_classes

base_model = MobileNetV2(include_top=False, weights='imagenet', input_shape=(160, 160, 3))
base_model.trainable = False  # Freeze awal

x = base_model.output
x = Conv2D(32, (3, 3), activation='relu', padding='same')(x)
x = MaxPooling2D(pool_size=(2, 2))(x)
x = Dropout(0.25)(x)

x = Conv2D(64, (3, 3), activation='relu', padding='same')(x)
x = MaxPooling2D(pool_size=(2, 2))(x)
x = Dropout(0.25)(x)

x = Flatten()(x)
x = Dense(128, activation='relu')(x)
x = Dropout(0.3)(x)
output = Dense(num_classes, activation='softmax')(x)

model = Model(inputs=base_model.input, outputs=output)
model.compile(optimizer=Adam(learning_rate=0.001), loss='categorical_crossentropy', metrics=['accuracy'])

# ========== Pretraining ==========
print("=== Pretraining (10 Epochs - Frozen Base) ===")
model.fit(
    train_gen,
    epochs=10,
    validation_data=val_gen
)

# ========== Fine-Tuning ==========
print("=== Fine-tuning (20 Epochs - Unfreeze Last 50 Layers) ===")
# Unfreeze sebagian besar layer dari base_model
for layer in base_model.layers[-50:]:
    layer.trainable = True

model.compile(optimizer=Adam(learning_rate=1e-5), loss='categorical_crossentropy', metrics=['accuracy'])

model.fit(
    train_gen,
    epochs=20,
    validation_data=val_gen
)

# ========== Evaluasi ==========
y_pred = model.predict(val_gen)
y_true = val_gen.classes
y_pred_labels = y_pred.argmax(axis=1)

print(confusion_matrix(y_true, y_pred_labels))
print(classification_report(y_true, y_pred_labels, target_names=encoded_labels))

# ========== Simpan Model ==========
model.save(MODEL_PATH)
print("Model selesai dilatih dan disimpan di:", MODEL_PATH)
