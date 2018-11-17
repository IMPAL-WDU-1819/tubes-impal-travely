<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Akun extends Base {
  public $idAkun;
  public $email;
  public $nama;
  public $password;

  public function cekAkun($email) {
    $data = $this->db->select('akun', 
      ['email'], 
      [],
      ['email' => $email]
    );

    return json_encode($data);
  }

  public function buatAkun($email, $password) {
    $insert = $this->db->insert('akun', 
      ['email' => $email, 'password' => $password]
    );

    return $insert;
  }

  public function getAkun($email, $password) {
    $data = $this->db->select('akun', 
      ['email'], 
      [],
      ['email' => $email, 'password' => $password]
    );

    return json_encode($data);
  }
}
