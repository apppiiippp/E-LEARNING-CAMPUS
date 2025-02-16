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
cd nama_folder
composer install
npm install
```

#### 3. Konfigurasi .env dan migrasi database:

```sh
php artisan migrate 
```

#### 4. Jalankan Server: 

```sh
php artisan serve
```


#### 5. Jalankan Websockets: 

```sh
php artisan websockets:serve
```


