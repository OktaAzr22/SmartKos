# Sistem Manajemen Keuangan Berbasis Laravel

Aplikasi **Manajemen Keuangan** berbasis **Laravel** yang dirancang untuk mencatat **pemasukan dan pengeluaran**, melakukan **rekap bulanan otomatis**, menampilkan **dashboard interaktif**, serta **mencetak laporan PDF**.  
Cocok digunakan untuk **pencatatan keuangan pribadi, anak kost, maupun UMKM kecil**.

---

## Fitur Utama

### Pemasukan
- Tambah data pemasukan melalui form
- Input **jumlah** dan **keterangan** (tanggal otomatis terisi)
- Data otomatis masuk ke perhitungan saldo

### Pengeluaran
- Tambah data pengeluaran dengan detail lengkap
- Kategori pengeluaran terstruktur
- Langsung mengurangi saldo

### Dashboard Interaktif
Menampilkan ringkasan keuangan secara **real-time**:
- Sisa Saldo Saat Ini
- Total Pemasukan
- Total Pengeluaran
- Grafik Pemasukan & Pengeluaran per **Bulan dan Tahun**
- Kategori Pengeluaran Teratas
- Riwayat Transaksi Terbaru

### Rekap Bulanan Otomatis
Rekap data berdasarkan **bulan & tahun**, menyimpan:
- Saldo awal
- Total pemasukan
- Total pengeluaran
- Saldo akhir

### Cetak Laporan PDF
- Cetak laporan bulanan ke **PDF**
- Detail lengkap:
  - Data pemasukan
  - Data pengeluaran
  - Ringkasan keuangan

### Manajemen Profil Pengguna
- Mengatur foto profil
- Mengubah nama
- Mengatur status
- Mengelola nomor telepon
- Data profil tersimpan dan dapat diperbarui kapan saja

### Tampilan
- Mendukung **Dark Mode**
- Sistem bawaan yang user-friendly

---

## Teknologi yang Digunakan

- **Backend:** Laravel 12
- **Database:** MySQL
- **Frontend:** Blade Templates Engine, Tailwind CSS
- **Visualisasi Data:** Chart.js
- **PDF Generator:** DomPDF
- **Ikon:** FontAwesome

---

## Instalasi & Setup

### Clone Repository
```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

### Install Dependency
```bash
composer install
npm install
npm run build
```

### Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Atur koneksi database di file `.env`:
```env
DB_DATABASE=keuangan
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database
```bash
php artisan migrate
```

### Jalankan Aplikasi
```bash
php artisan serve
```

Akses melalui browser:
```
http://127.0.0.1:8000
```

---

## Pengembangan Selanjutnya

Saran dan ide fitur selanjutnya **sangat berharga** untuk pengembangan sistem ini.

---

## ©️ Copyright

**Ramayansa © 2025**