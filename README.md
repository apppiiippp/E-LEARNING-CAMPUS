# Sistem E-Learning Campus
E-Learning Kampus adalah platform pembelajaran digital yang dirancang untuk memfasilitasi interaksi antara dosen dan mahasiswa dalam proses belajar mengajar. Sistem ini memungkinkan pengelolaan pembelajaran melalui fitur yang disediakan.


## Features
###### 1. Sistem Autentikasi Mahasiswa & Dosen
- Login dan registrasi untuk mahasiswa dan dosen.
###### 2.Manajemen Mata Kuliah & Kelas Online
- Dosen dapat membuat, mengedit, dan menghapus mata kuliah.
- Mahasiswa dapat mendaftar ke dalam kelas yang tersedia.
###### 3. Upload & Unduh Materi Perkuliahan
- Dosen dapat mengunggah materi dalam berbagai format (PDF, PPT, Video, dll.).
- Mahasiswa dapat mengunduh materi yang tersedia.
###### 4. Tugas & Penilaian
- Dosen dapat memberikan tugas kepada mahasiswa.
- Mahasiswa dapat mengumpulkan tugas sebelum batas waktu.
- Dosen dapat memberikan penilaian dan feedback pada tugas.
###### 5. Forum Diskusi
- Mahasiswa dan dosen dapat berinteraksi melalui forum diskusi.
###### 6. Laporan & Statistika
- Statistik jumlah mahasiswa per mata kuliah.
- Statistik tugas yang sudah/belum dinilai.
- Statistik tugas dan nilai mahasiswa tertentu.

## Tech
- Bahasa Pemrograman: PHP 8.2
- Framework: Laravel 10
- Database: MySQL
- Software : Postman dan VisualStudicode

## Installation
#### 1. Clone repository:

```sh
git clone https://github.com/apppiiippp/E-LEARNING-CAMPUS.git
```
#### 2. Install dependencies:

```sh
cd repository
composer install
npm install
```

### 3. Generate Application Key
```sh
php artisan key:generate
```

#### 4.  Konfigurasi Database
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Jalankan Migrasi Database
```sh
php artisan migrate
```
#### 6. Jalankan Server Laravel
```sh
php artisan serve
```

## Konfigurasi Email
```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Nama Aplikasi"
```

## Buat notifikasi baru
```sh
php artisan make:notification nama_notifikasi
```

## Install laravel websockets
```sh
composer require beyondcode/laravel-websockets
```

## Publikasi Konfigurasi WebSockets
```sh
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
```
## Konfigurasi WebSockets di .env
```sh
PUSHER_APP_ID=local
PUSHER_APP_KEY=anyKey
PUSHER_APP_SECRET=anySecret
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
```
## Konfigurasi broadcasting.php
```sh
'default' => env('BROADCAST_DRIVER', 'pusher'),

'connections' => [
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => false,
            'host' => env('PUSHER_HOST'),
            'port' => env('PUSHER_PORT'),
            'scheme' => env('PUSHER_SCHEME'),
        ],
    ],
],

```
## Buat Event yang Dapat Disiarkan (Broadcasting Event)
```sh
php artisan make:event message
```

##  Jalankan Server WebSockets
```sh
php artisan websockets:serve
```
#Debug Websocket
```sh
http://127.0.0.1:8000/laravel-websockets
```







