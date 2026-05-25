<h1 align="center">
  <img src="public/images/EDUZI NEW LOGO.png" alt="Logo" height="40" style="vertical-align: middle; margin-right: 10px;">
  <strong>Eduzi</strong>
</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red?logo=laravel&style=for-the-badge" />
  <img src="https://img.shields.io/badge/Livewire-3-blueviolet?logo=livewire&style=for-the-badge" />
  <img src="https://img.shields.io/badge/TailwindCSS-3-38bdf8?logo=tailwindcss&style=for-the-badge" />
  <img src="https://img.shields.io/badge/Status-In_Development-orange?style=for-the-badge" />
</p>

---

<p align="center">
  <img src="public/images/EDUZI NEW LOGO.png" alt="App Logo">
</p>

<p align="center"><strong>Aplikasi Eduzi sebagai Media Edukasi Gizi Digital dalam Pencegahan Stunting.</strong></p>

---

## 👥 Project Contributors – Eduzi

| Name | Role | GitHub Username |
|------|------|----------------|
| Muhammad Faiq | Backend Developer & Database Integration | [@Mufaaaa](https://github.com/Mufaaaa) |
| Nania Maharanny | Frontend Developer & UI/UX Designer | [@ljnnna](https://github.com/ljnnna) |

---


> 📝 *Each contributor played an important role in the development of Eduzi.*

---

## 📦 About the Project

Eduzi adalah aplikasi edukasi gizi digital yang dirancang untuk membantu masyarakat memahami pentingnya gizi seimbang serta pencegahan stunting pada anak. Aplikasi ini menyediakan informasi kesehatan, kalkulator gizi, dan fitur edukatif yang mudah diakses sehingga dapat menjadi media pembelajaran digital bagi orang tua dan masyarakat dalam menjaga pertumbuhan dan kesehatan anak. 

---

## 🌟 Key Features

- 🧮 **Kalkulator Gizi Anak** – Membantu memantau status gizi anak berdasarkan data pertumbuhan.
- 📊 **Hasil Analisis Gizi** – Menampilkan kategori status gizi anak secara informatif.
- 👤 **Riwayat Pemeriksaan** – Menyimpan data hasil pengecekan pengguna.
- 📚 **Konten Edukasi** – Artikel dan video seputar gizi dan pencegahan stunting.
- 💬 **Forum Komunitas** – Tempat berbagi pengalaman dan diskusi bersama pengguna lain.
---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, MySQL  
- **Frontend:** TailwindCSS, Blade  
- **Full-stack Tooling:** Livewire  
- **Admin Panel:** Filament  
- **Dependency Tools:** npm, Composer  

---

## 🚀 Getting Started

### **Prerequisites**
- PHP 8.3+
- Composer
- Node.js & NPM
- MySQL

---

### 💻 Installation (Step-by-Step)

1. **Clone the repository and navigate to the project directory**
    ```bash
    git clone https://github.com/Mufaaaa/eduzi.git
   cd laravel
    ```

2. **Install backend and frontend dependencies**
    ```bash
    composer install
    npm install
    ```

3. **Copy and configure the environment file**
    ```bash
    cp .env.example .env
    # Edit the .env file:
    # - DB_DATABASE=your_database
    # - DB_USERNAME=your_username
    # - DB_PASSWORD=your_password
    ```

4. **Generate application key and migrate the database**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```

5. **Build frontend assets and run the development server**
    ```bash
    npm run dev
    php artisan serve
    ```

🔗 Access the application via your browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---
