<?php

require 'vendor/autoload.php';

use Medoo\Medoo;

$database = new Medoo([
  'database_type' => 'mysql',
  'database_name' => 'travely',
  'server' => 'localhost:3306',
  'username' => 'root',
  'password' => 'root'
]);

class Stasiun {
	public $idStasiun;
	public $namaStasiun;
	public $domisili;  

	public function getDomisili() {
		global $database;
		$data = $database->select('stasiun', [
				'[><]domisili' => ['domisili' => 'id_domisili']
			],
			'domisili.nama_domisili'
		);
		return json_encode($data);
	}
}