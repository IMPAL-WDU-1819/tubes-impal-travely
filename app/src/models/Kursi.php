<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Kursi extends Base {
	public function getKursiKosong($jadwal) {
		$data = $this->db->query(
			"select <kursi.no_kursi> from <kursi> where <no_kursi> not in (select <tiket.kursi> from <tiket> where <tiket.jadwal> = :id_jadwal) and <kursi.kereta> = (select <jadwal.kereta> from <jadwal> where <jadwal.id_jadwal> = :id_jadwal)", [
				":id_jadwal" => $jadwal
			]
		)->fetchAll();

		return json_encode($data);
	}
}
