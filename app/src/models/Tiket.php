<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Tiket extends Base {
	public function getETiket($id) {
		$data = $this->db->select('tiket');

		
		return json_encode($data);
	}
}