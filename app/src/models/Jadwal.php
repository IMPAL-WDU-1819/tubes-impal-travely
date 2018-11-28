<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Jadwal extends Base {
  public $idJadwal;
  public $asal;
  public $tujuan;
  public $tanggal;

  public function cariJadwal($asal, $tujuan, $tanggal_berangkat) {
    $data = $this->db->select('jadwal', [
        '[><]stasiun' => ['stasiun_asal' => 'id_stasiun'],
        '[><]stasiun' => ['stasiun_tujuan' => 'id_stasiun'],
        '[><]kereta' => ['kereta' => 'id_kereta'],
      ],
      [
        'kereta.nama_kereta',
        'jadwal.stasiun_asal',
        'jadwal.stasiun_tujuan'
      ],
      [
        'jadwal.stasiun_asal' => $asal,
        'jadwal.stasiun_tujuan' => $tujuan,
        'jadwal.stasiun_tanggal_berangkat' => $tanggal_berangkat
      ]
    );

    // $data = $this->db->query("select <kereta.nama_kereta>, <jadwal.stasiun_asal>, <jadwal.stasiun_tujuan>, <stasiun.nama_stasiun> from <jadwal> inner join <stasiun> on <jadwal.stasiun_asal> = <stasiun.id_stasiun> inner join <keret>a on <jadwal.kereta> = <kereta.id_kereta> where <jadwal.stasiun_asal> = :stasiun_asal and <jadwal.stasiun_tujuan> = :stasiun_tujuan and <jadwal.tanggal_berangkat> = :tanggal_berangkat and <kereta.kapasitas> - (select count(<tiket.kursi>) as kursi_terpesan from <tiket> inner join <jadwal> on <tiket.jadwal> = <jadwal.id_jadwal> where <tiket.jadwal> = :id_jadwal) > :jumlah_pemesan;", [
    //   ":stasiun_asal" => $asal,
    //   ":stasiun_tujuan" => $tujuan,
    //   ":tanggal_berangkat" => $tanggal_berangkat,
    //   ":jumlah_pemesan" $jumlah_pemesan
    // ])->fetchAll();

    return json_encode($data);
  }
}
