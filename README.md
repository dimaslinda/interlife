# 🌟 InterLife - Modern Web Application

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Filament-3.x-F59E0B?style=for-the-badge&logo=php&logoColor=white" alt="Filament">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

## 📖 Tentang InterLife

InterLife adalah aplikasi web modern yang dibangun dengan Laravel dan Filament Admin Panel. Aplikasi ini dirancang untuk mengelola konten website perusahaan dengan fitur-fitur lengkap dan antarmuka yang user-friendly.

### ✨ Fitur Utama

- 🎨 **Banner Management** - Kelola banner homepage dengan mudah
- 💼 **Portfolio Management** - Showcase proyek dan karya dengan kategori
- 🛠️ **Services Management** - Kelola layanan yang ditawarkan
- 🤝 **Partners Management** - Manajemen mitra dan klien
- 📋 **Process Management** - Kelola alur kerja dan proses bisnis
- 📞 **Contact Management** - Sistem kontak dan inquiry
- ⚙️ **SEO Settings** - Pengaturan SEO untuk optimasi mesin pencari
- 🔧 **Footer Settings** - Kustomisasi footer website
- 👥 **User Management** - Manajemen pengguna dengan notifikasi
- 📧 **Email System** - Sistem email terintegrasi
- 📱 **Responsive Design** - Tampilan yang optimal di semua perangkat

## 🚀 Teknologi yang Digunakan

- **Backend**: Laravel 11.x
- **Admin Panel**: Filament 3.x
- **Database**: MySQL/PostgreSQL
- **Media Management**: Spatie Media Library
- **Queue System**: Laravel Queue
- **Email**: Laravel Mail
- **Frontend**: Blade Templates, Vite
- **Styling**: Tailwind CSS (via Filament)

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Web Server (Apache/Nginx)

## 🛠️ Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd interlife
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=interlife
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

## 🔐 Akses Admin Panel

Setelah instalasi, Anda dapat mengakses admin panel di:
```
http://localhost:8000/admin
```

Gunakan kredensial yang dibuat melalui seeder atau buat user baru dengan:
```bash
php artisan make:filament-user
```

## 📁 Struktur Proyek

```
interlife/
├── app/
│   ├── Filament/          # Filament Resources & Widgets
│   ├── Models/            # Eloquent Models
│   ├── Mail/              # Mail Classes
│   ├── Notifications/     # Notification Classes
│   └── Providers/         # Service Providers
├── database/
│   ├── migrations/        # Database Migrations
│   └── seeders/          # Database Seeders
├── resources/
│   ├── views/            # Blade Templates
│   └── css/              # Stylesheets
└── routes/               # Route Definitions
```

## 🎯 Penggunaan

### Mengelola Konten
1. Login ke admin panel
2. Navigasi ke menu yang diinginkan (Banners, Services, Portfolio, dll.)
3. Tambah, edit, atau hapus konten sesuai kebutuhan
4. Konten akan otomatis tersinkronisasi dengan website

### Konfigurasi SEO
1. Akses menu "SEO Settings"
2. Atur meta title, description, dan keywords
3. Upload favicon dan logo
4. Simpan perubahan

### Manajemen Media
- Upload gambar melalui form yang tersedia
- Sistem akan otomatis mengoptimalkan ukuran gambar
- Media dapat dikelola melalui Spatie Media Library

## 🔧 Konfigurasi Email

Untuk mengaktifkan fitur email, konfigurasikan SMTP di file `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yoursite.com
MAIL_FROM_NAME="InterLife"
```

## 🚀 Deployment

### Production Setup
1. Upload files ke server
2. Install dependencies: `composer install --optimize-autoloader --no-dev`
3. Build assets: `npm run build`
4. Set permissions untuk storage dan cache
5. Konfigurasi web server
6. Setup SSL certificate

### Environment Variables
Pastikan variabel berikut dikonfigurasi untuk production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Silakan:
1. Fork repository ini
2. Buat branch untuk fitur baru
3. Commit perubahan Anda
4. Push ke branch
5. Buat Pull Request

## 📝 License

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan, silakan:
- Buat issue di repository ini
- Hubungi tim development

---

<p align="center">Dibuat dengan ❤️ menggunakan Laravel & Filament</p>
