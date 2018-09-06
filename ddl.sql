CREATE TABLE akun (
  id varchar(16) NOT NULL PRIMARY KEY,
  email varchar(100),
  nama varchar(100),
  password varchar(25),
  tanggal_lahir varchar(10),
  nomor_telepon varchar(15),
  alamat text
);

CREATE TABLE kereta (
  id_kereta varchar(16) NOT NULL PRIMARY KEY,
  nama_kereta varchar(20),
  kapasitas int(3)
);

CREATE TABLE domisili (
  id_domisili varchar(3) NOT NULL PRIMARY KEY,
  nama_domisili varchar(20)
);

CREATE TABLE stasiun (
  id_stasiun varchar(16) NOT NULL PRIMARY KEY,
  nama_stasiun varchar(20),
  domisili varchar(3),
  FOREIGN KEY (domisili) REFERENCES domisili (id_domisili)
);

CREATE TABLE tipe_kursi (
  tipe varchar(5) NOT NULL PRIMARY KEY,
  harga int(10)
)

CREATE TABLE kursi (
  id_kursi varchar(16) NOT NULL PRIMARY KEY,
  no_kusi varchar(5),
  kereta varchar(16),
  kelas varchar(3),
  FOREIGN KEY (kereta) REFERENCES kereta (id_kereta),
  FOREIGN KEY (kelas) REFERENCES tipe_kursi (tipe)
);

CREATE TABLE transaksi (
  id_transaksi varchar(16) NOT NULL PRIMARY KEY,
  tanggal_transaksi varchar(10),
  total varchar(10),
  email varchar(100),
  status varchar(10)
);

CREATE TABLE jadwal (
  id_jadwal varchar(16) NOT NULL PRIMARY KEY,
  tanggal_berangkat varchar(10),
  tanggal_tiba varchar(10),
  stasiun_asal varchar(16),
  stasiun_tujuan varchar(16),
  waktu_berangkat varchar(5),
  waktu_sampai varchar(5),
  kereta varchar(16),
  FOREIGN KEY (stasiun_asal) REFERENCES stasiun (id_stasiun),
  FOREIGN KEY (stasiun_tujuan) REFERENCES stasiun (id_stasiun),
  FOREIGN KEY (kereta) REFERENCES kereta (id_kereta)
);

CREATE TABLE tiket (
  id_tiket varchar(16) NOT NULL PRIMARY KEY,
  status varchar(10),
  kursi varchar(16),
  jadwal varchar(16),
  FOREIGN KEY (kursi) REFERENCES kursi (id_kursi)
);

CREATE TABLE item_transaksi (
  transaksi varchar(16),
  tiket varchar(16),
  FOREIGN KEY (transkasi) REFERENCES transaksi (id_transaksi),
  FOREIGN KEY (tiket) REFERENCES tiket (id_tiket),
);
