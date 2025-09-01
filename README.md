# Sistem Informasi Pengelolaan Pameran Dealer

Aplikasi ini dirancang untuk membantu pengelolaan pameran dealer, dilengkapi dengan fitur prediksi lokasi pameran menggunakan metode **SAW (Simple Additive Weighting)**.  
Dibangun menggunakan **PHP** dan **MySQL** sebagai database.

## 🚀 Fitur Utama
- **Kelola User**
  - **Marketing** → mengelola event, penilaian lokasi, monitoring laporan.
  - **Dealer** → mengajukan proposal event pameran.
- **Kelola Lokasi**
  - CRUD data lokasi pameran.
  - Penilaian lokasi menggunakan kriteria yang ditentukan.
- **Hasil Penilaian Lokasi (SAW)**
  - Perhitungan bobot dan skor lokasi pameran.
  - Menentukan lokasi terbaik berdasarkan metode **SAW**.
- **Pengajuan Proposal Event**
  - Dealer dapat mengajukan proposal pameran.
  - Proses verifikasi dan persetujuan oleh Marketing.
- **Realisasi Event**
  - Input data realisasi event pameran yang telah dilaksanakan.
- **Kalender Event**
  - Menampilkan jadwal event pameran dalam bentuk kalender.
- **Monitoring LPJ**
  -  monitoring Laporan Pertanggungjawaban (LPJ) setelah event.

## 🛠️ Teknologi yang Digunakan
- PHP 7.4+
- MySQL
- Bootstrap / CSS
- FullCalendar.js (untuk kalender event)
- Chart.js

## ⚙️ Instalasi
1. Clone repository:
   ```bash
   git clone https://github.com/USERNAME/sistem-pameran-dealer.git
   cd sistem-pameran-dealer
2. Buat database baru, contoh: db_pameran.
Import file database/db_pameran.sql.
3. Atur koneksi database
4. Jalankan aplikasi di browser:

👥 Role User
Marketing
Mengelola data lokasi dan penilaian SAW.
Menyetujui proposal event.
Monitoring realisasi dan LPJ.
Dealer
Mengajukan proposal event pameran.
Melihat status persetujuan event.
Menambahkan lokasi event

📌 Catatan
Aplikasi ini menggunakan metode SAW (Simple Additive Weighting) untuk memberikan rekomendasi lokasi pameran terbaik berdasarkan kriteria yang ditentukan.
