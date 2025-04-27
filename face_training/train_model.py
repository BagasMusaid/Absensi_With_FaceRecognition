import os
import json
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Flatten, Dense, Dropout
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.optimizers import Adam
from sklearn.preprocessing import LabelEncoder

# ======== Konfigurasi Path =========
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DATASET_DIR = os.path.join(BASE_DIR, "public", "storage", "face-labels")
SISWA_JSON = os.path.join(BASE_DIR, "face_training", "siswa.json")
ENCODER_PATH = os.path.join(BASE_DIR, "face_training", "label_encoder.json")
MODEL_PATH = os.path.join(BASE_DIR, "face_training", "face_model.h5")

# ======== Hapus Model Lama =========
if os.path.exists(MODEL_PATH):
    os.remove(MODEL_PATH)
    print(" Model lama dihapus.")

if os.path.exists(ENCODER_PATH):
    os.remove(ENCODER_PATH)
    print("Label encoder lama dihapus.")

# ======== ImageDataGenerator =========
datagen = ImageDataGenerator(
    rescale=1./255,
    validation_split=0.2,
    rotation_range=15,
    width_shift_range=0.1,
    height_shift_range=0.1,
    zoom_range=0.1,
    horizontal_flip=True
)

train_gen = datagen.flow_from_directory(
    DATASET_DIR,
    target_size=(160, 160),
    batch_size=16,
    class_mode='categorical',
    subset='training',
    shuffle=True
)

print("Folder yang digunakan untuk training:")
print(os.listdir(DATASET_DIR))

print("Label yang terdeteksi:")
print(train_gen.class_indices)

val_gen = datagen.flow_from_directory(
    DATASET_DIR,
    target_size=(160, 160),
    batch_size=16,
    class_mode='categorical',
    subset='validation',
    shuffle=True
)

# ======== Simpan Label Encoder (NIS ke Nama) =========
nis_list = list(train_gen.class_indices.keys())  # ['20230123', '20230124', ...]
encoded_labels = [None] * len(train_gen.class_indices)

# Ambil data siswa dari siswa.json
try:
    with open(SISWA_JSON, "r") as f:
        siswa_map = json.load(f)
except Exception as e:
    print(f"Error saat membaca file siswa.json: {e}")
    siswa_map = {}

# Mengisi encoded_labels dengan nama siswa
for label, index in train_gen.class_indices.items():
    nama = siswa_map.get(label, "Unknown")
    encoded_labels[index] = f"{nama} ({label})"

# Menyimpan encoded_labels ke dalam file JSON
try:
    with open(ENCODER_PATH, "w") as f:
        json.dump(encoded_labels, f)
    print("Label encoder berhasil disimpan.")
except Exception as e:
    print(f"Error saat menyimpan label encoder: {e}")

print("Label yang digunakan:")
for i, label in enumerate(encoded_labels):
    print(f"{i}: {label}")

# ======== Definisi Model CNN Conv2D =========
model = Sequential([
    Conv2D(32, (3, 3), activation='relu', input_shape=(160, 160, 3), padding='same'),
    MaxPooling2D(pool_size=(2, 2)),
    Dropout(0.25),

    Conv2D(64, (3, 3), activation='relu', padding='same'),
    MaxPooling2D(pool_size=(2, 2)),
    Dropout(0.25),

    Flatten(),
    Dense(128, activation='relu'),
    Dropout(0.5),
    Dense(train_gen.num_classes, activation='softmax')
])

model.compile(
    optimizer=Adam(learning_rate=0.001),
    loss='categorical_crossentropy',
    metrics=['accuracy']
)

# ======== Training Model =========
model.fit(
    train_gen,
    epochs=30,
    validation_data=val_gen
)

# ======== Simpan Model =========
model.save(MODEL_PATH)
print("Model CNN selesai dilatih dan disimpan ke:", MODEL_PATH)

