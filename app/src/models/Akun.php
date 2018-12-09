<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Akun extends Base {
  public function cekAkun($email) {
    $data = $this->db->select('akun', 
      ['akun.email'],
      ['email' => $email]
    );

    return json_encode($data);
  }

  public function buatAkun($email, $password) {
    $insert = $this->db->insert('akun', 
      ['email' => $email, 'nama' => '', 'password' => $password]
    );

    return $insert;
  }

  public function getAkun($email, $password) {
    $data = $this->db->select('akun',
      ['akun.email'],
      ['akun.email' => $email, 'akun.password' => $password]
    );

    return json_encode($data);
  }

  public function getDetail($email) {
    $data = $this->db->select('akun',
      ['akun.email', 'akun.nama'], 
      ['akun.email' => $email]
    );

    return json_encode($data);
  }
}
