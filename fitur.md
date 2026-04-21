Berikut adalah daftar detail fiturnya yang sudah saya format menjadi *list* (blok teks). 

Nanti, Anda cukup *copy* salah satu blok fitur di bawah ini, lalu *paste* ke saya. Setelah itu, saya akan langsung men- *generate* kode lengkapnya (Routes, Controller, dan Views Tailwind) sesuai dengan blok yang Anda kirimkan.

---

### **[FITUR 1] Kelola Data Kamar (Rooms)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Resource route `rooms` di dalam grup pemilik.
    * **Controller:** `RoomController` (Fungsi index, create, store, edit, update, destroy).
    * **Views (Tailwind):** `pemilik/rooms/index.blade.php`, `create.blade.php`, dan `edit.blade.php`.
    * **Logic:** Form dengan *dropdown* untuk memilih `room_type_id`, input nomor kamar, lantai, dan foto fisik kamar.

### **[FITUR 2] Kelola Akun & Profil Penyewa (Tenants)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Resource route `tenants` di dalam grup pemilik.
    * **Controller:** `TenantController`.
    * **Views (Tailwind):** `pemilik/tenants/index.blade.php`, `create.blade.php`, dan `edit.blade.php`.
    * **Logic (Penting):** Saat membuat penyewa baru, sistem akan otomatis membuatkan akun di tabel `users` (dengan *role* penyewa & *password default*), lalu mengaitkannya dengan data NIK, No. HP, dan Alamat di tabel `tenants`.

### **[FITUR 3] Kelola Kontrak Sewa (Contracts)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Resource route `contracts` di dalam grup pemilik.
    * **Controller:** `ContractController`.
    * **Views (Tailwind):** `pemilik/contracts/index.blade.php`, `create.blade.php`, dan `show.blade.php` (untuk melihat detail).
    * **Logic (Penting):** Saat kontrak disimpan, status di tabel `rooms` otomatis berubah menjadi "terisi". Validasi agar kamar yang statusnya "terisi" tidak bisa disewa lagi.

### **[FITUR 4] Generate Tagihan & Denda (Bills)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Custom route untuk melihat tagihan dan men- *generate* tagihan baru.
    * **Controller:** `BillController`.
    * **Views (Tailwind):** `pemilik/bills/index.blade.php`.
    * **Logic (Penting):** Tombol "Buat Tagihan Bulan Ini". Mencegah duplikasi tagihan di bulan/tahun yang sama untuk satu kontrak. Kalkulasi denda otomatis jika tanggal saat ini melebihi `due_date`.

### **[FITUR 5] Konfirmasi Pembayaran (Payments - Admin)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Custom route untuk halaman konfirmasi dan proses persetujuan.
    * **Controller:** `PaymentController` (Sisi Admin).
    * **Views (Tailwind):** `pemilik/payments/index.blade.php` (Daftar menunggu konfirmasi).
    * **Logic (Penting):** Melihat foto bukti transfer. Saat dikonfirmasi, status tagihan (Bills) berubah menjadi `lunas` dan mencatat ID Admin yang menyetujui.

### **[FITUR 6] Laporan Keuangan Excel (Export)**
* **Role:** Pemilik (Admin)
* **Isi yang akan dibuat:**
    * **Route:** Custom route untuk *download* laporan.
    * **Controller:** `ReportController`.
    * **Views (Tailwind):** Halaman filter tanggal/bulan laporan.
    * **Logic:** Query data tagihan yang sudah lunas, lalu di- *export* ke format `.xlsx` atau `.csv` (memenuhi syarat paket ujian).

### **[FITUR 7] Lihat Tagihan Saya (My Bills - Tenant)**
* **Role:** Penyewa (Tenant)
* **Isi yang akan dibuat:**
    * **Route:** Custom route di dalam grup penyewa.
    * **Controller:** `TenantBillController` (Read-only).
    * **Views (Tailwind):** `penyewa/bills/index.blade.php`.
    * **Logic:** Hanya menampilkan tagihan yang berelasi dengan ID user penyewa yang sedang *login*. Menampilkan nominal harga + denda (jika telat).

### **[FITUR 8] Upload Bukti Pembayaran (Payment - Tenant)**
* **Role:** Penyewa (Tenant)
* **Isi yang akan dibuat:**
    * **Route:** Custom route GET (form bayar) dan POST (upload).
    * **Controller:** `TenantPaymentController`.
    * **Views (Tailwind):** `penyewa/payments/create.blade.php` (Form upload foto).
    * **Logic:** Validasi ekstensi file gambar (`jpg, png, jpeg`). Setelah di- *upload*, status tagihan berubah menjadi `menunggu_konfirmasi`.

### **[FITUR 9] Pemisahan Navigasi Sesuai Role (Navbar)**
* **Role:** Pemilik & Penyewa
* **Isi yang akan dibuat:**
    * **Modifikasi File:** Mengedit `resources/views/layouts/navigation.blade.php` bawaan Laravel Breeze.
    * **Logic:** Menggunakan direktif Blade `@if(auth()->user()->role === 'pemilik')` untuk menampilkan deretan menu Pemilik (Kamar, Penyewa, Tagihan), dan `@elseif(auth()->user()->role === 'penyewa')` untuk deretan menu Penyewa (Tagihan Saya).