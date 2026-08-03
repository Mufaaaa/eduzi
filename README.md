# FastAPI – Eduzi

Proyek ini merupakan REST API berbasis **FastAPI** untuk melakukan prediksi atau analisis terkait asma menggunakan beberapa model machine learning yang disimpan dalam format `.joblib`.

## Cara Setup & Menjalankan Aplikasi


1. **Clone Repository**

      ```bash
       git clone https://github.com/Mufaaaa/eduzi.git
       cd fastapi
      ```


2. **Buat Virtual Environment**
      ```bash
      python -m venv venv
      ```


3. **Install Dependencies**
      ```bash
      pip install --upgrade pip
      pip install -r requirements.txt
      ```


4. **Jalankan Server FastAPI**
      ```bash
      uvicorn app.main:app --host 127.0.0.1 --port 8080 --reload
      ```
      
🔗 Access the application via your browser: [http://127.0.0.1:8080](http://127.0.0.1:8080)

---
      
