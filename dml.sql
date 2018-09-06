INSERT INTO akun VALUES ('1721631823', 'test@email.com', 'Test', 'test', '10-10-1987', '+6281987652542', 'Test');

INSERT INTO kereta VALUES ('RG9123', 'Test', 100);

INSERT INTO domisili VALUES ('BDO', 'Bandung');

INSERT INTO stasiun VALUES ('KD', 'Kiaracondong', 'BDO'), ('KT', 'Kota', 'BDO');

INSERT INTO tipe_kursi VALUES ('VIP', 500000), ('REG', 250000);

INSERT INTO kursi VALUES ('CK0918237', '001', 'RG9123', 'VIP');

INSERT INTO transaksi VALUES ('TR1029386', '10-10-2018', 500000, 'test@email.com', 'Pending');

INSERT INTO jadwal VALUES ('SH1238120', '10-10-2018', '11-10-2018', 'KD', 'KT', '14.30', '8.30', 'RG9123');

INSERT INTO tiket VALUES ('TC098123', 'Pending', 'CK0918273', 'SH1238120');

INSERT INTO item_transaksi VALUES ('TR1029386', 'TC098123');

# Select Query

SELECT * FROM transaksi WHERE email = 'test@email.com';
