<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Tiket extends Base {
	public function getETiket($id) {
		$data = $this->db->select('tiket', 
			['[><]kursi' => ['kursi' => 'id_kursi']],
			['tiket.id_tiket', 'tiket.kursi', 'tiket.identitas', 
			 'tiket.nama', 'tiket.jadwal', 'kursi.no_kursi'],
			['tiket.transaksi' => $id]
		);
		return json_encode($data);
	}

	public function addTiket($id, $kursi, $transaksi, 
		$identitas, $nama, $jadwal) {
		$insert = $this->db->insert('tiket', 
			['id_tiket' => $id, 'kursi' => $kursi, 
			 'transaksi' => $transaksi,  'identitas' => $identitas, 
			 'nama' => $nama, 'jadwal' => $jadwal]
		);

		return json_encode($insert);
	}
}