# 🏢 Kosku - Sistem Manajemen Kos

`Kosku` adalah aplikasi manajemen kos berbasis web untuk membantu pemilik kos dalam mengelola kamar, tipe kamar, penyewa, kontrak, tagihan, pembayaran, dan laporan keuangan. Aplikasi ini juga menyediakan *dashboard* khusus bagi penyewa untuk memantau tagihan dan mengunggah bukti pembayaran secara mandiri.

---

## Fitur Utama

Sistem ini memiliki 2 *role* utama dengan alur kerja masing-masing:

### Dashboard Pemilik (Admin)
- **Manajemen Aset:** Kelola Tipe Kamar (harga, fasilitas) dan Data Kamar.
- **Manajemen Penghuni:** Pendaftaran data penyewa otomatis dengan pembuatan akun login.
- **Kontrak Sewa:** Pembuatan kontrak sewa untuk menghubungkan penyewa dan kamar.
- **Otomatisasi Tagihan:** *Generate* tagihan bulanan otomatis untuk semua kontrak aktif dengan jatuh tempo 7 hari.
- **Validasi Pembayaran:** Konfirmasi atau tolak bukti transfer yang diunggah penyewa.
- **Laporan Keuangan:** *Export* data pendapatan berdasar rentang waktu ke format CSV/Excel.

### Dashboard Penyewa (User)
- **Ringkasan Tagihan:** Pantau total tagihan aktif dan tanggal jatuh tempo.
- **Upload Pembayaran:** Unggah foto/screenshot bukti transfer pembayaran (*jpg, jpeg, png*).
- **Riwayat:** Melihat status tagihan (Belum Bayar, Menunggu Konfirmasi, Lunas).

---

## Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan *tech stack* modern:
- **Framework:** Laravel 13
- **Bahasa:** PHP 8.3+
- **Autentikasi:** Laravel Breeze
- **Styling UI:** Tailwind CSS (Custom Theme: Merah, Putih, Abu-abu + *Glass effect*)
- **Asset Bundler:** Vite

---

## Screenshots

*(Catatan: Simpan gambar screenshot di folder repo, lalu sesuaikan nama file di bawah ini)*

| Dashboard Pemilik | Dashboard Penyewa |
| :---: | :---: |
| ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/Screenshot%202026-04-23%20192646.png?raw=true)| ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/penyewa.png?raw=true) |

| Kelola Tipe Kamar | Kelola Kamar |
| :---: | :---: |
| ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/tipe%20kamar.png?raw=true) | ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/kamar.png?raw=true) |

| Generate Tagihan | Laporan Keuangan |
| :---: | :---: |
| ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/tagihan.png?raw=true) | ![alt text](https://github.com/qollapavalo-cpu/kosku-Sistem-Manajemen-kos/blob/main/public/images/laporan.png?raw=true) |

---

## ⚙️ Panduan Instalasi (Local Development)

Jalankan perintah berikut secara berurutan di terminal Anda untuk memasang dan menjalankan proyek ini di komputer lokal:

```bash
# Clone repository dan masuk ke folder aplikasi
git clone <repository-url>
cd kosku-sistem-manajemen-kos

# Install semua dependency PHP dan Node.js
composer install
npm install

# Setup environment variabel
copy .env.example .env      # Catatan: Gunakan 'cp .env.example .env' jika di Linux/Mac
php artisan key:generate
