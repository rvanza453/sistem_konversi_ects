# Fitur Manajemen Admin

## Deskripsi
Fitur ini memungkinkan admin untuk membuat, mengedit, dan menghapus akun admin lainnya dalam sistem.

## Fitur yang Tersedia

### 1. Daftar Admin
- Menampilkan semua admin yang terdaftar
- Informasi: Nama, Email, Tanggal Dibuat
- Tombol aksi: Edit dan Hapus

### 2. Tambah Admin Baru
- Form untuk menambah admin baru
- Validasi: Nama, Email (unik), Password (konfirmasi)
- Password di-hash secara otomatis

### 3. Edit Admin
- Form untuk mengubah data admin
- Password opsional (kosongkan jika tidak ingin mengubah)
- Validasi email unik (kecuali untuk admin yang sedang diedit)

### 4. Hapus Admin
- Konfirmasi sebelum menghapus
- Admin tidak dapat menghapus akunnya sendiri
- Hanya admin yang dapat dihapus

## Keamanan

### Middleware
- Semua route dilindungi dengan `AdminMiddleware`
- Hanya user dengan role 'admin' yang dapat mengakses

### Validasi
- Email harus unik
- Password minimal 8 karakter
- Konfirmasi password wajib saat membuat admin baru

### Proteksi
- Admin tidak dapat menghapus akunnya sendiri
- Hanya admin yang dapat diedit/dihapus

## Akses

### Login Admin Default
- Email: `admin@admin.com`
- Password: `password`

### Navigasi
- Menu "Manajemen Admin" tersedia di navigation bar untuk admin
- URL: `/admin/admin`


## Cara Penggunaan

1. Login sebagai admin
2. Klik menu "Manajemen Admin" di navigation bar
3. Untuk menambah admin baru, klik tombol "+ Tambah Admin"
4. Isi form dengan data admin baru
5. Untuk mengedit, klik tombol "Edit" pada baris admin yang diinginkan
6. Untuk menghapus, klik tombol "Hapus" (akan ada konfirmasi)

