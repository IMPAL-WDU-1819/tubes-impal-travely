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

class Kereta {
	public $idKereta;
	public $namaKereta;
	public $kapasitas;  
}

public function cekKapasitas($id) {
	global $database;
	$data = $database->select('kereta', [
    'kapasitas'
	], [
    'id_kereta' => $id
	]);

	return json_encode($data);
}