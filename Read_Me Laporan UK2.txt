           LAPORAN & DOKUMENTASI UJI KOMPETENSI 2 (WEB PROGRAMMING)
                         KELOMPOK Farrel Razan A

ANGGOTA KELOMPOK:
1. 2301020096 - Farrel Razan (Ketua)
2. 2301020038 - Rizky Sudaryo
3. 2301020115 - Akbar Nurrahman
4. 2301020116 - Tito Pamungkas Wardana
5. 2301020063 - Rodiyan Ramadhan
6. 2301020035 - Fajri Hasan
7. 2301020059 - Muhamad Radit
8. 2301020013 - Aurel
9. 2301020023 - Sabriyah
10. 2301020004 - Ahmad Zidane

A. Demo User
Catatan : Semua Password untuk akun di bawah ini adalah: 123

1. ADMINISTRATOR (MASTER)
   - Username : admin
   - Akses    : Full Control (CRUD User, Fakultas, Jurusan, Prodi)

2. PIMPINAN FAKULTAS (DEKAN)
   - Nama     : Martaleli Bettiza (Dekan FTTK)
   - Username : 19800105
   - Fungsi   : Melihat Summary Kuisioner seluruh prodi di FTTK.

   - Nama     : Dr. Sayed Fauzan (Dekan FISIP)
   - Username : 19800101
   - Fungsi   : Untuk pengujian isolasi data (Dashboard kosong/beda).

3. KAPRODI
   - Nama     : Kaprodi Teknik Informatika
   - Username : 200101
   - Fungsi   : Membuat Soal & Periode khusus TI.

4. MAHASISWA
   - Nama     : Farrel Razan (Mhs Informatika)
   - Username : 2301020096
   - Fungsi   : Mengisi kuisioner TI & Cek History Jawaban.

   - Nama     : Mhs Dummy Elektro (Mhs T.Elektro)
   - Username : 2301020030
   - Fungsi   : Untuk pengujian bahwa Mhs TI tidak bisa isi kuis TE.

B. Logika Tambahan

Aplikasi ini telah menerapkan logika "Multi-Tenancy" dan "Data Isolation" 
untuk menjaga integritas data akademik :

1. ISOLASI DASHBOARD PIMPINAN (Hierarki)
   - Dekan FTTK hanya bisa melihat laporan kuisioner dari prodi-prodi 
     di bawah naungan FTTK (TI, Elektro, Sipil, dll).
   - Dekan FTTK TIDAK BISA melihat data kuisioner Fakultas Lain (misal FISIP).
   - Pimpinan yang login otomatis dideteksi memimpin fakultas apa.

2. ISOLASI AKSES MAHASISWA
   - Mahasiswa Teknik Informatika HANYA melihat kuisioner yang ditujukan 
     untuk Prodi Teknik Informatika.
   - Mahasiswa TI TIDAK BISA mengisi atau melihat kuisioner milik 
     Teknik Elektro atau prodi lain, meskipun satu fakultas.

3. ISOLASI HAK AKSES KAPRODI
   - Kaprodi TI hanya bisa memanipulasi (CRUD) pertanyaan untuk Prodi TI.
   - Kaprodi TI tidak bisa menghapus/mengedit soal milik Kaprodi Sipil.

4. HISTORY JAWABAN (Persistence)
   - Jika mahasiswa sudah mengisi kuisioner, lalu logout dan login kembali,
     jawaban sebelumnya akan otomatis muncul (Radio button terpilih).
   - Mahasiswa bisa mengubah jawaban sebelum periode ditutup.

5. MANAJEMEN DATA MASTER (CRUD)
   - Admin memiliki fitur lengkap untuk Menambah, Mengedit, dan Menghapus:
     User, Fakultas, Jurusan, dan Prodi.
   - Hal ini mengantisipasi pergantian pejabat (Dekan/Kaprodi) atau 
     perubahan nama nomenklatur prodi di masa depan.

C. Teknologi Pendukung
1. Framework   : CodeIgniter 4
2. Styling     : Tailwind CSS (CDN) - Modern UI
3. Interaksi   : Alpine.js (Modal, Dropdown, Logic Frontend)
4. Grafik      : Chart.js (Visualisasi Summary Pimpinan/Kaprodi)
5. Notifikasi  : SweetAlert2 (Pop-up sukses/gagal yang interaktif)
6. Animasi     : AOS (Animate On Scroll)

D. Catatan Tambahan
Semuanya bekerja dengan baik dan sinkron.