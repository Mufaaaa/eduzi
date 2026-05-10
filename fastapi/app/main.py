from fastapi import FastAPI
from pydantic import BaseModel
import pandas as pd
import joblib
import os
from dotenv import load_dotenv
from google import genai

# =========================================
# INIT APP
# =========================================

app = FastAPI()

# =========================================
# LOAD ENV
# =========================================

load_dotenv()

GEMINI_API_KEY = os.getenv("GEMINI_API_KEY")

# =========================================
# GEMINI CONFIG
# =========================================

gemini_client = genai.Client(
    api_key=GEMINI_API_KEY
)

# =========================================
# LOAD MODEL
# =========================================

model = joblib.load("app/models/best_model.joblib")
scaler = joblib.load("app/models/scaler.joblib")
encoder = joblib.load("app/models/Jenis Kelamin_encoder.joblib")

# =========================================
# REQUEST BODY
# =========================================

class PredictionInput(BaseModel):

    jenis_kelamin: str
    umur_bulan: int
    tinggi_badan: float
    berat_badan: float

# =========================================
# ROOT
# =========================================

@app.get("/")
def home():

    return {
        "message": "API Prediksi Status Gizi Aktif"
    }

# =========================================
# PREDICT
# =========================================

@app.post("/predict")
def predict(data: PredictionInput):

    try:

        # =========================================
        # NORMALISASI INPUT GENDER
        # =========================================

        jenis_kelamin = data.jenis_kelamin.strip().lower()

        if jenis_kelamin == "laki-laki":

            jenis_kelamin = "Laki-laki"

        elif jenis_kelamin == "perempuan":

            jenis_kelamin = "Perempuan"

        else:

            return {
                "error": "Jenis kelamin tidak valid"
            }

        # =========================================
        # ENCODE GENDER
        # =========================================

        gender = encoder.transform([
            jenis_kelamin
        ])[0]

        # =========================================
        # DATAFRAME INPUT
        # =========================================

        input_data = pd.DataFrame([[
            gender,
            data.umur_bulan,
            data.tinggi_badan,
            data.berat_badan
        ]], columns=[
            "Jenis Kelamin",
            "Umur (bulan)",
            "Tinggi Badan (cm)",
            "Berat Badan (kg)"
        ])

        # =========================================
        # SCALING
        # =========================================

        scaled_data = scaler.transform(input_data)

        # =========================================
        # PREDICT MODEL
        # =========================================

        prediction = model.predict(scaled_data)[0]

        # =========================================
        # HASIL PREDIKSI
        # =========================================

        if prediction == 1:

            result = "Stunting"

            penjelasan = (
                "Stunting merupakan kondisi gagal tumbuh pada anak akibat "
                "kekurangan gizi dalam waktu yang cukup lama.\n\n"
                "Kondisi ini dapat memengaruhi pertumbuhan fisik, "
                "perkembangan otak, serta daya tahan tubuh anak.\n\n"
                "Penting untuk memperhatikan asupan nutrisi harian, "
                "terutama protein hewani, vitamin, dan mineral "
                "agar pertumbuhan anak dapat lebih optimal."
            )

        else:

            result = "Gizi Baik (Normal)"

            penjelasan = (
                "Gizi Baik (Normal) berarti asupan energi dan nutrisi anak "
                "saat ini telah mencukupi kebutuhan untuk menunjang "
                "pertumbuhan fisik dan perkembangan motoriknya.\n\n"
                "Pada usia pertumbuhan, anak memerlukan asupan makanan "
                "yang seimbang agar berat badan dan tinggi badan "
                "tetap berkembang secara optimal.\n\n"
                "Tetap pertahankan pola makan sehat, aktivitas fisik, "
                "dan pemantauan pertumbuhan secara rutin."
            )

        # =========================================
        # PROMPT GEMINI
        # =========================================

        prompt = f"""
Anda adalah ahli gizi anak.

Data anak:
- Jenis kelamin: {jenis_kelamin}
- Umur: {data.umur_bulan} bulan
- Tinggi badan: {data.tinggi_badan} cm
- Berat badan: {data.berat_badan} kg
- Status gizi: {result}

Berikan rekomendasi dengan format berikut:

1. Pola makan sehat
Isi penjelasan singkat.

2. Nutrisi penting
Isi penjelasan singkat.

3. Tips pertumbuhan
Isi penjelasan singkat.

Gunakan bahasa Indonesia yang mudah dipahami orang tua.
Maksimal 120 kata.
Jangan gunakan markdown atau tanda bintang.
Gunakan paragraf singkat dan rapi.
"""

        # =========================================
        # GEMINI RESPONSE
        # =========================================

        try:

            gemini_response = gemini_client.models.generate_content(
                model="gemini-2.5-flash",
                contents=prompt
            )

            rekomendasi_ai = gemini_response.text

            # =========================================
            # CLEAN TEXT
            # =========================================

            rekomendasi_ai = rekomendasi_ai.replace("**", "")
            rekomendasi_ai = rekomendasi_ai.replace("* ", "• ")
            rekomendasi_ai = rekomendasi_ai.replace("##", "")

            # Rapikan enter berlebih
            rekomendasi_ai = rekomendasi_ai.replace("\n\n\n", "\n\n")
            rekomendasi_ai = rekomendasi_ai.replace("\n\n", "\n")

            # Rapikan spasi
            rekomendasi_ai = rekomendasi_ai.strip()

            if rekomendasi_ai:

                rekomendasi = rekomendasi_ai

            else:

                rekomendasi = (
                    "• Lanjutkan pemberian makanan bergizi seimbang\n"
                    "• Berikan protein hewani seperti telur, ikan, ayam, dan susu\n"
                    "• Perbanyak konsumsi sayur dan buah setiap hari\n"
                    "• Terapkan jadwal makan teratur dan cukup air putih\n"
                    "• Lakukan pemantauan berat dan tinggi badan secara rutin"
                )

        except Exception as e:

            print("ERROR GEMINI:", e)

            # =========================================
            # FALLBACK RESPONSE
            # =========================================

            rekomendasi = (
                "• Lanjutkan pemberian makanan bergizi seimbang\n"
                "• Berikan protein hewani seperti telur, ikan, ayam, dan susu\n"
                "• Perbanyak konsumsi sayur dan buah setiap hari\n"
                "• Terapkan jadwal makan teratur dan cukup air putih\n"
                "• Lakukan pemantauan berat dan tinggi badan secara rutin"
            )

        # =========================================
        # RETURN RESPONSE
        # =========================================

        return {
            "prediction": result,
            "prediction_code": int(prediction),
            "penjelasan": penjelasan,
            "rekomendasi": rekomendasi
        }

    except Exception as e:

        return {
            "error": str(e)
        }