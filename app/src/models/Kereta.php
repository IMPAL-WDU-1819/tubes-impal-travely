<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Kereta extends Base {
  public function cekKapasitas($id) {
	  $data = $this->db->select('kereta', 
		  ['kapasitas'], 
		  ['id_kereta' => $id]
		);

	  return json_encode($data);
	}
}
