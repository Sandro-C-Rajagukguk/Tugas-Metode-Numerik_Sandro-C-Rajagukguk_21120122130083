# DESKRIPSI
Dokumen ini menjelaskan alur dan implementasi kode untuk melakukan regresi linear dan regresi pangkat sederhana untuk menentukan hubungan antara durasi waktu belajar (TB) dan nilai ujian (NT). Kode ini ditulis dalam PHP dan Python. PHP digunakan untuk membaca data, melakukan perhitungan regresi, dan menyimpan hasil prediksi ke file CSV, sementara Python digunakan untuk memplot grafik data dan hasil regresi. Hasil dari dua metode regresi dibandingkan dengan menghitung galat RMS (Root Mean Square).

# Konsep
## Regresi Linear
Regresi linear adalah metode untuk memodelkan hubungan antara variabel independen (X) dan variabel dependen (Y) dengan mencocokkan persamaan linear ke data yang diamati.
Persamaan regresi linear:
Y=mX+c
di mana:
𝑌 adalah variabel dependen (nilai ujian).
𝑋 adalah variabel independen (waktu belajar).
𝑚 adalah kemiringan garis.
𝑐 adalah intersep.

## Regresi Pangkat Sederhana
Regresi pangkat digunakan untuk memodelkan hubungan yang tidak linier antara variabel independen dan dependen. Persamaan dasarnya adalah:
Y=cX^m
## RMS
Root Mean Square Error (RMSE) adalah ukuran galat yang digunakan untuk mengevaluasi model regresi. Ini memberikan gambaran tentang seberapa baik model memprediksi hasil.
