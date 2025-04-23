
# Panduan Instalasi E-Catalog
Panduan ini akan memandu Anda melalui langkah-langkah untuk menginstal aplikasi.
## Prasyarat
Sebelum memulai, pastikan Anda telah menginstal perangkat lunak berikut:
- Git
- Composer
## Langkah-langkah Instalasi
### 1. Kloning repositori:
```bash
git clone https://github.com/bay195/e-catalog.git
cd e-catalog
```
### 2. Instal dependensi Laravel & Vite:
```bash
composer install
npm install
npm run dev
```
### 3. Hasilkan file .env dan kunci aplikasi:
di terminal baru:
```bash
cd e-catalog
```
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Konfigurasi Basis Data:
- Buat database baru dengan nama e_catalog
- Konfigurasikan file .env
  ```env
  DB_DATABASE=e_catalog
  DB_USERNAME=root
  DB_PASSWORD=
  ```
### 5. Jalankan:
```bash
php artisan migrate:fresh --seed
```
### 6. Jalankan aplikasi web:
```bash
php artisan serve
```


# Panduan menggunakan aplikasi
Panduan ini akan menjelaskan bagaimana cara menggunakan aplikasi
### 1. Role
Aplikasi ini memiliki 5 Role yang sudah tersedia di database diantaranya:
- Guest : Role ini memposisikan diri sebagai Pengunjung yang dapat melihat dan memilih item yang telah melalui proses entry, dan juga dapat melihat & menghapus item yang sudah dipilih. 
- User Admin : Role ini memposisikan diri sebagai Admin yang bertugas memulai proses entry data (menambahkan item pertamakali) untuk kemudian disubmit ke FAT Admin. Role ini dapat Menambahkan data, Mengedit data sebelum disubmit, Menghapus data, dan Melihat daftar guest & items yang dipilihnya.
- FAT Admin : Role ini memposisikan diri sebagai Admin yang bertugas untuk melengkapi data yang telah disubmit oleh User Admin untuk kemudian disubmit ke Procurement Admin. Role ini dapat Mengedit data sebelum disubmit, Menghapus data, dan Melihat daftar guest & items yang dipilihnya.
- Procurement Admin : Role ini memposisikan diri sebagai Admin yang bertugas untuk melengkapi data yang telah disubmit oleh FAT Admin untuk kemudian disubmit ke Logistik Admin. Role ini dapat Mengedit data sebelum disubmit, Menghapus data, dan Melihat daftar guest & items yang dipilihnya.
- Logistik Admin : Role ini memposisikan diri sebagai Admin yang bertugas untuk melengkapi data yang telah disubmit oleh Procurement Admin untuk kemudian disubmit untuk mengakhiri proses entry data. Role ini dapat Mengedit data sebelum disubmit, Menghapus data, dan Melihat daftar guest & items yang dipilihnya.
### 2. Login
Terdapat 5 akun pada database sesuai rolenya:
1. Guest :
   - Email: guest@example.com
   - Password: password
2. User Admin :
   - Email: user@example.com
   - Password: password
3. FAT Admin :
   - Email: fat@example.com
   - Password: password
4. Procurement Admin :
   - Email: procurement@example.com
   - Password: password
5. Logistik Admin :
   - Email: logistik@example.com
   - Password: password

*) Logout dapat dilakukan melalui menu dropdown di kanan atas.
### 3. Data Entry
Setiap Admin memiliki tugas berbeda untuk melengkapi data items:
1. User Admin:
   - Kode Item : String
   - INC : String
   - Item Type : String
   - Item Group : String
   - UOM : String
   - Denotation : String
   - Keyword : String
   - Deskripsi : Text
   - Old Code: String
   - Cross Ref 1 : String
   - Cross Ref 2 : String
   - Cross Ref 3 : String
   - Functional Location : String
2. FAT Admin:
   - COA : String
   - GL : String
3. Procurement Admin:
   - Unit Price : Decimal
   - Main Supplier : String
4. Logistik Admin:
   - Storage Location : String
   - Max Stock Level : Integer
   - Reorder Point : Integer
### 4. CRUD
- Edit Data hanya dapat dilakukan ketika data berada di fase review oleh masing-masing role, tidak dapat diedit jika sudah disubmit.
- Submit Data hanya dapat dilakukan ketika seluruh kolom data sudah terisi.
- Hapus Data dapat dilakukan oleh seluruh admin ketika data berada di fase manapun.

