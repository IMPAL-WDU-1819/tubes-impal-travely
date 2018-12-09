# 1. Domisili
SELECT 
	domisili.nama_domisili,
	stasiun.id_stasiun 
FROM 
	stasiun 
INNER JOIN 
	domisili ON stasiun.domisili = domisili.id_domisili;

# 2. Jadwal kereta
SELECT 
  jadwal.id_jadwal,
  kereta.nama_kereta,
  kereta.id_kereta, 
  jadwal.stasiun_asal,
  jadwal.stasiun_tujuan, 
  jadwal.waktu_berangkat, 
  jadwal.waktu_sampai,
  kelas.harga,
  kelas.nama_kelas
FROM 
  jadwal 
INNER JOIN 
  kereta ON jadwal.kereta = kereta.id_kereta
INNER JOIN 
  kelas ON kereta.kelas = kelas.id_kelas 
WHERE 
  jadwal.stasiun_asal = :stasiun_asal 
  AND jadwal.stasiun_tujuan = :stasiun_tujuan 
  AND jadwal.tanggal_berangkat = :tanggal_berangkat 
  AND kereta.kapasitas - (
    SELECT
      count(tiket.kursi) AS kursi_terpesan 
    FROM 
      tiket 
    INNER JOIN 
      jadwal ON tiket.jadwal = jadwal.id_jadwal 
    WHERE jadwal.id_jadwal IN (
      SELECT 
        jadwal.id_jadwal 
      FROM 
        jadwal
      WHERE 
        jadwal.stasiun_asal = :stasiun_asal 
        AND jadwal.stasiun_tujuan = :stasiun_tujuan 
        AND jadwal.tanggal_berangkat = :tanggal_berangkat)) > :jumlah_pemesan

# 3. Kursi kosong
SELECT 
	kursi.id_kursi,
	kursi.no_kursi,
	kursi.kereta
FROM
	kursi
WHERE
	kursi.id_kursi NOT IN (
		SELECT 
			tiket.kursi 
		FROM 
			tiket 
		WHERE 
			tiket.jadwal = :id_jadwal)
		AND kursi.kereta = (
			SELECT 
				jadwal.kereta 
			FROM 
				jadwal
			WHERE 
				jadwal.id_jadwal = :id_jadwal)
ORDER BY kursi.no_kursi ASC