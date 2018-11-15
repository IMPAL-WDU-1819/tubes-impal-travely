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

class Akun {
  public $idAkun;
  public $email;
  public $nama;
  public $password;

  public function cekAkun($email) {
    global $database;
    $data = $database->select('akun', 
      ['email'], 
      [],
      ['email' => $email]
    );

    return json_encode($data);
  }

  public function buatAkun($email, $password) {
    global $database;
    $insert = $database->insert('akun', 
      ['email' => $email, 'password' => $password]
    );

    return $insert;
  }

  public function getAkun($email, $password) {
    global $database;
    $data = $database->select('akun', 
      ['email'], 
      [],
      ['email' => $email, 'password' => $password]
    );

    return json_encode($data);
  }
}