# Client Preview — Car Wash & Home Cleaning Service

Versi statis mandiri (*standalone static preview*) untuk dipresentasikan kepada calon klien. Dibuat khusus menggunakan **HTML5, CSS3, dan Vanilla JavaScript murni** tanpa dependensi PHP, Laravel, Composer, Node.js, atau database MySQL.

---

## 📁 Struktur Direktori

```text
client-preview/
├── css/
│   └── style.css          # Stylesheet CSS3 modern, responsif, minimalis
├── js/
│   └── main.js            # Vanilla JavaScript (navigasi mobile, dynamic dropdown, modal)
├── index.html             # Halaman Utama (Home)
├── car-wash.html          # Layanan Car Wash & Detailing
├── home-cleaning.html     # Layanan Home Cleaning
├── about.html             # Tentang Kami & Standar Pelayanan
├── contact.html           # Kontak & Formulir Pesan
├── booking.html           # Formulir Simulasi Booking
├── vercel.json            # Konfigurasi deployment Vercel (clean URLs & security headers)
└── README.md              # Dokumentasi & panduan deployment
```

---

## 🚀 Cara Menjalankan Secara Lokal

Anda dapat membuka website preview ini dengan beberapa metode yang sangat mudah:

### Opsi 1: Langsung di Browser (Tanpa Server)
Cukup klik ganda (*double click*) file `index.html` di dalam folder `client-preview/`. Halaman akan langsung terbuka di browser Anda (Chrome, Edge, Safari, Firefox).

### Opsi 2: Menggunakan VS Code Live Server
1. Buka folder `client-preview` di VS Code.
2. Klik kanan pada `index.html`.
3. Pilih **"Open with Live Server"**.

### Opsi 3: Menggunakan Python (CLI)
Jika memiliki Python terinstal di komputer:
```bash
cd client-preview
python -m http.server 3000
```
Buka `http://localhost:3000` di browser.

### Opsi 4: Menggunakan npx serve
```bash
npx serve client-preview
```

---

## ☁️ Panduan Deployment ke Vercel

Folder `client-preview` telah dikonfigurasi agar dapat di-deploy secara mandiri (*standalone*) ke Vercel tanpa dependensi backend.

### Opsi A: Deploy Melalui Vercel CLI (Paling Cepat)
1. Buka terminal dan masuk ke folder `client-preview`:
   ```bash
   cd client-preview
   ```
2. Jalankan perintah Vercel:
   ```bash
   vercel
   ```
3. Ikuti prompt interaktif di terminal (pilih *Yes* untuk deploy direktori saat ini).
4. Untuk deployment produksi:
   ```bash
   vercel --prod
   ```

### Opsi B: Deploy Melalui Git Repository di Vercel Dashboard
1. Hubungkan repository Git Anda ke akun [Vercel](https://vercel.com).
2. Pada menu konfigurasi project di Vercel:
   - **Root Directory**: Ubah menjadi `client-preview`.
   - **Framework Preset**: Pilih `Other` (Static HTML).
   - **Build & Output Settings**: Biarkan default (tidak memerlukan build command).
3. Klik **Deploy**.

---

## 💡 Fitur-Fitur Client Preview

- **Design Minimalis & Elegan**: Menggunakan palet Deep Navy (`#142B3B`), Fresh Teal (`#28B8A7`), dan latar bersih (`#F5F8F7`).
- **Bebas Dependensi Gambar**: Menggunakan typography Inter, CSS layout, badge, dan icon SVG vektor yang ringan.
- **Simulasi Form Booking**: Formulir interaktif dengan dropdown jenis layanan dinamis berdasarkan kategori. Saat disubmit, memunculkan notifikasi modal bahwa sistem pemesanan riil akan aktif di versi final.
- **100% Aman & Privasi Terjaga**: Tidak ada data pribadi atau koneksi API/database yang terekspos.

