<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Balikin - Sistem Lost & Found Kampus

**Balikin** adalah sebuah platform berbasis web yang dirancang untuk membantu komunitas kampus dalam melaporkan dan menemukan barang yang hilang di area universitas. Proyek ini dibangun menggunakan framework Laravel 12 sebagai tugas akhir mata kuliah Pemrograman Framework Web.

---

## 📋 Fitur Utama

Sistem ini memiliki dua peran utama: **User** (Mahasiswa, Dosen, Staf) dan **Admin**.

#### Fitur untuk User:
-   🔐 **Autentikasi**: Register, login, dan logout.
-   👤 **Manajemen Profil**: Mengubah informasi profil pribadi.
-   [cite_start]📄 **Lapor Barang Hilang**: Membuat laporan kehilangan barang lengkap dengan nama barang, deskripsi, tanggal, lokasi, dan foto[cite: 318, 327].
-   [cite_start]🙋 **Lapor Barang Temuan**: Membuat laporan penemuan barang[cite: 55, 125].
-   [cite_start]🔍 **Lihat Daftar Barang**: Menelusuri daftar barang yang hilang dan ditemukan yang sudah divalidasi[cite: 61, 62, 349].
-   [cite_start]✏️ **Kelola Laporan**: Mengedit dan menghapus laporan milik sendiri[cite: 57, 58, 59, 60].
-   [cite_start]🔎 **Pencarian**: Mencari barang spesifik dari daftar yang ada[cite: 63].

#### Fitur untuk Admin:
-   🔒 **Akses Terbatas**: Login khusus untuk admin.
-   [cite_start]✅ **Validasi Laporan**: Menyetujui atau menolak laporan barang hilang/temuan yang dikirim oleh user[cite: 56, 104, 381].
-   [cite_start]👥 **Manajemen User**: Menambah atau menghapus akun user yang terdaftar di sistem[cite: 64, 153, 425, 426].
-   📊 **Dashboard**: Melihat semua daftar barang yang dilaporkan, baik yang sudah divalidasi maupun yang belum.

---

## 🚀 Teknologi yang Digunakan

* **Backend**: PHP 8.x, Laravel 12
* **Frontend**: HTML, CSS, JavaScript, Blade Template Engine
* **Database**: MySQL
* **Development Tools**: Composer, Git, GitHub

---

## 🧑‍💻 Tim Pengembang

| Nama Anggota        | NIM           | Peran & Tanggung Jawab                                     |
| ------------------- | ------------- | ---------------------------------------------------------- |
| **Ferdi Yansah** | `2310631170084` | **Backend**: Database, Autentikasi, Role & Manajemen User.   |
| **Erika Sita Dewi** | `2310631170078` | **Backend & Frontend**: Modul Lapor & Lihat Barang Hilang.   |
| **Ariella Chandra Naya** | `2310631170006` | **Backend & Frontend**: Modul Barang Temuan & Validasi Admin. |

---

## ⚙️ Panduan Instalasi (Lokal)

1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/](https://github.com/)[username-anda]/balikin.git
    cd balikin
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

3.  **Setup file .env:**
    ```bash
    cp .env.example .env
    ```
    * Buat database baru (misal: `db_balikin`).
    * Sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) di file `.env`.

4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan migrasi database:**
    ```bash
    php artisan migrate
    ```

6.  **Jalankan server development:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.
