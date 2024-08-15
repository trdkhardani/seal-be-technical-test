# SEAL Backend Technical Test

## Brief Task
Kamu baru saja diterima sebagai seorang magang backend developer di sebuah perusahaan teknologi yang sedang mengembangkan aplikasi manajemen tugas (task management application) untuk tim-tim proyek. Aplikasi ini bertujuan untuk membantu anggota tim mengatur dan memantau tugas-tugas mereka dengan lebih efisien

## Profil
Nama: Tridiktya Hardani Putra

PT: Institut Teknologi Sepuluh Nopember (ITS) Surabaya

## Deskripsi Tugas
1. API untuk Pengguna:
   - Fungsi: Mengelola data pengguna.
   - Operasi:
       - POST
       - GET
       - PUT
       - DELETE
   - Untuk field database silahkan di sesuaikan sendiri, namun wajib ada field avatar / photo profile pada data pengguna

2. API untuk Tugas:
   - Fungsi: Mengelola data tugas.
   - Operasi:
       - POST
       - GET
       - PUT
       - DELETE

3. API untuk Proyek:
   - Fungsi: Mengelola data proyek.
   - Operasi:
       - POST
       - GET
       - PUT
       - DELETE

4. Autentikasi dan Autorisasi:
   - Implementasikan sistem autentikasi sederhana, misalnya menggunakan token JWT, untuk memastikan hanya pengguna yang terdaftar yang bisa mengakses API.
   - Tambahkan middleware untuk memeriksa token autentikasi sebelum memproses permintaan.

5. Relasi Antar Data:
   - Setiap proyek bisa memiliki beberapa tugas.
   - Setiap tugas harus terkait dengan satu pengguna yang bertanggung jawab

