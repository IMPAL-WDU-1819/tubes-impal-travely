<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Kursi extends Base {
	public function getKursiKosong($jadwal) {
		$data = $this->db->query("
			SELECT 
				<kursi.id_kursi>,
				<kursi.no_kursi>,
				<kursi.kereta>
			FROM
				<kursi>
			WHERE
				<kursi.id_kursi> NOT IN (
					SELECT 
						<tiket.kursi> 
					FROM 
						<tiket> 
					WHERE 
						<tiket.jadwal> = :id_jadwal)
					AND <kursi.kereta> = (
						SELECT 
							<jadwal.kereta> 
						FROM 
							<jadwal>
						WHERE 
							<jadwal.id_jadwal> = :id_jadwal)
			ORDER BY <kursi.no_kursi> ASC", [
			":id_jadwal" => $jadwal
		])->fetchAll();

		return json_encode($data);
	}
}
