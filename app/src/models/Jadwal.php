<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Jadwal extends Base {
  public function getJadwal($id) {
    $data = $this->db->query("
      SELECT
        <jadwal.tanggal_berangkat>,
        <asal.nama_stasiun> AS <stasiun_asal>,
        <tujuan.nama_stasiun> AS <stasiun_tujuan>,
        <kereta.nama_kereta>,
        <kelas.harga>
      FROM
        <jadwal>
      INNER JOIN
        <kereta> ON <jadwal.kereta> = <kereta.id_kereta>
      INNER JOIN
        <kelas> ON <kereta.kelas> = <kelas.id_kelas>
      INNER JOIN
        <stasiun> <asal> ON <jadwal.stasiun_asal> = <asal.id_stasiun>
      INNER JOIN
        <stasiun> <tujuan> ON <jadwal.stasiun_tujuan> = <tujuan.id_stasiun>
      WHERE
        <jadwal.id_jadwal> = :id_jadwal", [
      ":id_jadwal" => $id
    ])->fetchAll();

    return json_encode($data);
  }

  public function cariJadwal($asal, $tujuan, $tanggal_berangkat, $jumlah_pemesan) {
    $data = $this->db->query("
      SELECT 
        <jadwal.id_jadwal>,
        <kereta.nama_kereta>,
        <kereta.id_kereta>, 
        <jadwal.stasiun_asal>,
        <jadwal.stasiun_tujuan>, 
        <jadwal.waktu_berangkat>, 
        <jadwal.waktu_sampai>,
        <kelas.harga>,
        <kelas.nama_kelas>
      FROM 
        <jadwal> 
      INNER JOIN 
        <kereta> ON <jadwal.kereta> = <kereta.id_kereta>
      INNER JOIN 
        <kelas> ON <kereta.kelas> = <kelas.id_kelas> 
      WHERE 
        <jadwal.stasiun_asal> = :stasiun_asal 
        AND <jadwal.stasiun_tujuan> = :stasiun_tujuan 
        AND <jadwal.tanggal_berangkat> = :tanggal_berangkat 
        AND <kereta.kapasitas> - (
          SELECT
            count(<tiket.kursi>) AS <kursi_terpesan> 
          FROM 
            <tiket> 
          INNER JOIN 
            <jadwal> ON <tiket.jadwal> = <jadwal.id_jadwal> 
          WHERE <jadwal.id_jadwal> IN (
            SELECT 
              <jadwal.id_jadwal> 
            FROM 
              <jadwal> 
            WHERE 
              <jadwal.stasiun_asal> = :stasiun_asal 
              AND <jadwal.stasiun_tujuan> = :stasiun_tujuan 
              AND <jadwal.tanggal_berangkat> = :tanggal_berangkat)) 
          > :jumlah_pemesan", [
      ":stasiun_asal" => $asal,
      ":stasiun_tujuan" => $tujuan,
      ":tanggal_berangkat" => $tanggal_berangkat,
      ":jumlah_pemesan" => $jumlah_pemesan
    ])->fetchAll();

    return json_encode($data);
  }
}
