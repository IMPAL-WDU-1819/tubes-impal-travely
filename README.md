# tubes-impal-travely

<p>Implementasi dan pengujian program</p>
<br />

### Struktur Direktori
<p><strong><code>/app</code></strong></p>
<p>Program atau implementasi dari perancangan perangkat lunak.</p>
<br />

<p><strong><code>/db</code></strong></p>
<p>Skenario query database.</p>
<br />

<p><strong><code>/docs</code></strong></p>
<p>Dokumen, dan diagram yang dibutuhkan untuk implementasi.</p>
<br />
  
### Memulai Program
<p>Pastikan PC atau laptop sudah terinstall <code>php</code> dan <code>composer</code>.</p>
<br />

<p>Lakukan langkah-langkah di bawah ini melalui command prompt atau terminal.</p>
<p>Pastikan Anda sudah berada pada direktori repository ini.</p>
<br />

<p>1. Clone atau download repo ini</p>
<p><code>git clone https://github.com/IMPAL-WDU-1819/tubes-impal-travely.git</code></p>
<br />

<p>2. Perbarui dependencies</p>
<p><code>cd app</code></p>
<p><code>composer update</code></p>
<br />

<p>3. Jalankan di server lokal</p>
<p><code>php -S 127.0.0.1:8000</code></p>
<br />

### Unit Test
<p>Jalankan perintah dibawah pada command prompt atau terminal untuk melakukan unit testing menggunakan PHPUnit</p>
<p><code>./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests</code></p>
<br />

### Konfigurasi Database
<p>Backup database berada pada direktori <strong><code>/app/src/dumps</code></strong></p>
<p>Parameter koneksi database berada pada file <code>db.json</code> pada direktori <strong><code>/app/src/configs</code></strong></p>
<br />

### Todo
- [x] Buat README
- [x] Skenario query
- [x] Struktur dasar aplikasi
- [x] Desain antarmuka
- [x] Implementasi diagram kelas
- [x] Buat unit test